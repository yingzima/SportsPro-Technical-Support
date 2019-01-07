<?php
class Database
{
	private $dsn, $username, $password;
	
	public function __construct() {
		$this->dsn = 'mysql:host=64.119.131.183;dbname=F17Team1';
		$this->username = 'F17Team1';
		$this->password = 'F17Team1';
		
	}
	
	public function connect() {
    
	try {
        $db = new PDO($this->dsn, $this->username, $this->password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
	return $db;
	}
}
?>