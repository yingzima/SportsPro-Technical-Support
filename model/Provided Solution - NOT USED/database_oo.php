<?php
class Database {
    private static $dsn = 'mysql:host=64.119.131.183;dbname=F17Team1';
    private static $username = 'F17Team1';
    private static $password = 'F17Team1';
    private static $db;

    private function __construct() {}

    public static function getDB () {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn,
                                    self::$username,
                                    self::$password);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                include('../errors/database_error.php');
                exit();
            }
        }
        return self::$db;
    }
}
?>