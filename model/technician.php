<?php
class Technician {
    public $firstName, $lastName;
    
    public function __construct($first, $last) {
        $this->firstName = $first;
        $this->lastName = $last;
    }
    
    public function getFullName() {
        $fullName = $this->firstName . " " . $this->lastName;
        return $fullName;
    }
}