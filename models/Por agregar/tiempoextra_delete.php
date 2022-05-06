<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM tiempoextra WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'El tiempo extra se eliminó correctamente';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Seleccione el elemento para eliminar primero';
	}

	header('location: tiempoextra.php');
	
?>