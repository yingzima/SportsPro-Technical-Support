<?php
require('database_oo.php');
require('technician.php');

// Create a new database ojbect and connect via function defined in database_oop.php
$db = new database();
$db = $db->connect();

// Access technician functions
require('../model/technician_db.php');

// Initiate action - default to 'list technicians'
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_technicians';
    }
}

if ($action == 'list_technicians') {
    // Get technician data
    $technicians = get_technicians();

    // Display the technician list
    include('technician_list.php');
} else if ($action == 'delete_technician') {
    $technician_id = filter_input(INPUT_POST, 'technician_id', FILTER_VALIDATE_INT);
    delete_technician($technician_id);
    header("Location: .");
} else if ($action == 'show_add_form') {
    include('technician_add.php');
} else if ($action == 'add_technician') {
    $first_name = filter_input(INPUT_POST, 'first_name');
    $last_name = filter_input(INPUT_POST, 'last_name');
    $phone = filter_input(INPUT_POST, 'phone');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');

    // Validate the inputs
    if (empty($first_name) || empty($last_name) || empty($phone) || 
        $email === NULL || $email === FALSE || empty($password)) {
            $error = "Invalid technician data. Check all fields and try again.";
            include('../errors/error.php');
    } else {
        add_technician($first_name, $last_name, $email, $phone, $password);
        header("Location: .");
    }
}
?>