<?php
require('../model/database_pdo.php');
require('../model/customer_db.php');
require('../model/country_db.php');

require('../model/fields.php');
require('../model/validate.php');

// Create Validate object
$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('first_name');
$fields->addField('last_name');
$fields->addField('address');
$fields->addField('city');
$fields->addField('state');
$fields->addField('postal_code');
$fields->addField('phone');
$fields->addField('email');
$fields->addField('password');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'search_customers';
    }
}

//instantiate variable(s)
$last_name = '';
$customers = array();

switch ($action) {
    case 'search_customers':
        include('customer_search.php');
        break;    
    case 'display_customers':
        $last_name = filter_input(INPUT_POST, 'last_name');
        if (empty($last_name)) {
            $message = 'You must enter a last name.';
        } else {
            $customers = get_customers_by_last_name($last_name);
        }
        include('customer_search.php');
        break;
    case 'display_customer':
        $customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_VALIDATE_INT);
        $customer = get_customer($customer_id);

        // Get data from $customer array
        $first_name = $customer['firstName'];
        $last_name = $customer['lastName'];
        $address = $customer['address'];
        $city = $customer['city'];
        $state = $customer['state'];
        $postal_code = $customer['postalCode'];
        $country_code = $customer['countryCode'];
        $phone = $customer['phone'];
        $email = $customer['email'];
        $password = $customer['password'];

        $countries = get_countries();
        include('customer_display.php');
        break;
    case 'update_customer':
        // Get data from POST request
        $customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_VALIDATE_INT);
        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $address = filter_input(INPUT_POST, 'address');
        $city = filter_input(INPUT_POST, 'city');
        $state = filter_input(INPUT_POST, 'state');
        $postal_code = filter_input(INPUT_POST, 'postal_code');
        $country_code = filter_input(INPUT_POST, 'country_code');
        $phone = filter_input(INPUT_POST, 'phone');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');

        // Validate form data
        $validate->text('first_name', $first_name, true, 1, 50);
        $validate->text('last_name', $last_name, true, 1, 50);
        $validate->text('address', $address, true, 1, 50);
        $validate->text('city', $city, true, 1, 50);
        $validate->text('state', $state, true, 1, 50);
        $validate->text('postal_code', $postal_code, true, 1, 20);
        $validate->phone('phone', $phone, true, 1, 20);
        $validate->email('email', $email, true, 1, 50);
        $validate->password('password', $password, true, 1, 20);

        // Load appropriate view based on hasErrors
        if ($fields->hasErrors()) {
            $countries = get_countries();
            include('customer_display.php');
        } else {
            update_customer($customer_id, $first_name, $last_name,
                    $address, $city, $state, $postal_code, $country_code,
                    $phone, $email, $password);
            include('customer_search.php');
        }
        break;
}
?>