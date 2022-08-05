<?php
	session_start();

	require_once '../../models/sesion_model.php';
	$login = new sesion_model();
	$historial = $login->historial_logout($_SESSION['id_historial']);

	session_destroy();

	header('location: ../../index.php');
?>