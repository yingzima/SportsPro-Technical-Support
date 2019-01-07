<?php
require('../model/database_pdo.php');
require('../model/incident_db.php');
require('../model/customer_db.php');
require('../model/technician.php');
require('../model/technician_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        if (isset($_SESSION['tech_user'])) {
            $action = 'returning_tech';
        } else {
            $action = 'view_login';
        }
    }
}

switch($action) {
    case 'view_login':
        $email = '';
        $password = '';
        include('tech_login.php');
        break;
    case 'login':
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        if (!empty($email) && !empty($password) && is_valid_technician_login($email, $password)) {
            $_SESSION['tech_user'] = get_technician_by_email($email);
            $technician_name = $_SESSION['tech_user']['firstName'] . ' ' .
                             $_SESSION['tech_user']['lastName'];
            $tech_id = $_SESSION['tech_user']['techID'];
            $incidents = get_incidents_assigned($tech_id);
            include('select_incident.php');
        } else {
            $error_message = 'Login failed. Missing or invalid email/password.';
            $password = '';
            include('tech_login.php');
        }
        break;
    case 'returning_tech':
        $email = $_SESSION['tech_user']['email'];
        $password = $_SESSION['tech_user']['password'];
        if (!empty($email) && !empty($password) && is_valid_technician_login($email, $password)) {
            $_SESSION['tech_user'] = get_technician_by_email($email);
            $technician_name = $_SESSION['tech_user']['firstName'] . ' ' .
                             $_SESSION['tech_user']['lastName'];
            $tech_id = $_SESSION['tech_user']['techID'];
            $incidents = get_incidents_assigned($tech_id);
            include('select_incident.php');
        } else {
            $error_message = 'Login failed. Missing or invalid email/password.';
            $password = '';
            include('tech_login.php');
        }
        break;
    case 'show_update_incident':
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $incident = get_incident($id);
        $_SESSION['incident'] = $incident;
        include('update_incident.php');
        break;
    case 'update_incident':
        $id = $_SESSION['incident']['incidentID'];
        $date = filter_input(INPUT_POST, 'date');
        $description = filter_input(INPUT_POST, 'description');
        if ($date == NULL || $date == FALSE || empty($date) || $date == "") {
            try {
                update_incident($incident_id, $date_closed, $description);
                include('incident_update_confirmation.php');
            } catch (Exception $e) {
                $error_message = $e->getMessage();
                display_error($error_message);
            }
        } 
        break;
    case 'logout':
        // End session
        $_SESSION = array();
        session_destroy();
        
        // Delete cookie from browser
        $name = session_name();
        $expire = strtotime('-1 year');
        $params = session_get_cookie_params();
        $path = $params['path'];
        $domain = $params['domain'];
        $secure = $params['secure'];
        $httponly = $params['httponly'];
        setcookie($name, '', $expire, $path, $domain, $secure, $httponly);
        
        // Reset email and password and return to main menu
        $email = '';
        $password = '';
        header("Location: ". $app_path);
        break;
    default:
        display_error("Unknown action: " . $action);
        break;
}