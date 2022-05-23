<?php
	session_start();
	include 'conn.php';

	if(!isset($_SESSION['admin']) || trim($_SESSION['admin']) == ''){
		header('location: http://localhost/Sistema-MVC/admin/home.php');
	}

	$sql = "SELECT * FROM admin WHERE id = '".$_SESSION['admin']."'";
	$query = $conn->query($sql);
	$user = $query->fetch_assoc();
	
?>