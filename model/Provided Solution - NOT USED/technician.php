<?php
class Technician {
    private $id, $first_name, $last_name, $email, $phone, $password;

    public function __construct($first_name, $last_name, $email, $phone, $password) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
    }

    public function getID() {
        return $this->id;
    }
    public function setID($value) {
        $this->id = $value;
    }

    public function getFirstName() {
        return $this->first_name;
    }
    public function setFirstName($value) {
        $this->first_name = $value;
    }

    public function getLastName() {
        return $this->last_name;
    }
    public function setLastName($value) {
        $this->last_name = $value;
    }

    public function getFullName() {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($value) {
        $this->email = $value;
    }

    public function getPhone() {
        return $this->phone;
    }
    public function setPhone($value) {
        $this->phone = $value;
    }

    public function getPassword() {
        return $this->password;
    }
    public function setPassword($value) {
        $this->password = $value;
    }
}
?>