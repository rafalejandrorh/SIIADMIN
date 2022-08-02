<?php
	$conn = new mysqli('localhost', 'root', '', 'siiadmin');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>