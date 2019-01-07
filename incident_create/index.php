<?php
require('../model/database_pdo.php');
require('../model/customer_db.php');
require('../model/product_db.php');
require('../model/incident_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'search_customers';
    }
}

//initialize variable(s)
$email = '';

switch($action) {
    case 'search_customers':
		include('search_customers.php');
        break;
	case 'display_incident':
		$email = filter_input(INPUT_POST, 'Email');
		if (empty($email)) {
        $message = 'You must enter an email.';
		include('search_customers.php');
		} else {
		// use function defined in customer_db.php to retrieve customer data.
        $customer = get_customer_by_email($email);
			// if customer doesn't exist, return message
			if ($customer == '') {
				$message = "An account does not exist with that email.";
				include('search_customers.php');
			}
			else {
		$wholeName = $customer['firstName'].' '.$customer['lastName'];
		$id = $customer['customerID'];
		// use function defined in products_db.php to retrieve customer specific products
		$products = get_products_by_customer($email);
		include ('display_incident.php');
		}
		}
        break;
    case 'create_incident':
		// Set variables
		$custID = filter_input(INPUT_POST, 'custid');
		$prodCode = filter_input(INPUT_POST, 'prodid');
		$subject = filter_input(INPUT_POST, 'Subject');
		$issue = filter_input(INPUT_POST, 'Description');
		
		// Validate the inputs and insert data into database
		if ( $subject === NULL || $issue === NULL || $subject === '' || $issue === '' ) {
        $message = "A Title and Description must be entered in order to log an incident.";
		include ('create_incident.php');
		}
		else {
			add_incident($custID, $prodCode, $subject, $issue);
			$success = "This incident was added to our database.";
			include ('create_incident.php');
			 }
        break;
	default: 
		include('../under_construction.php');
}
?>

