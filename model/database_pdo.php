<?php
$dsn = 'mysql:host=64.119.131.183;dbname=maying';
$username = 'maying';
$password = 'S5817';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('../errors/database_error.php');
    exit();
}

function display_db_error($error_message) {
    include '../errors/database_error.php';
    exit;
}

?>