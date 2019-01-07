<?php
class Technician
{
	
	// Create a method that takes a technician from the $technicians array and returns full name.
	public static function get_names($technician) {
		
	$name = $technician['firstName'].' '.$technician['lastName'];
	
	return $name;
	}
}
?>