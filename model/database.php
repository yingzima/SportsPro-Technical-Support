<?php

	# Open the database
@ $db = new mysqli('64.119.131.183', 'maying', 'maying', 'S5817');
if ($db->connect_error) {
	echo "could not connect: " . $db->connect_error;
	exit();
}
?>