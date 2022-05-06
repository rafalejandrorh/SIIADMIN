<?php
	$conn = new mysqli('localhost', 'root', '', 'asistencia_nomina');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>