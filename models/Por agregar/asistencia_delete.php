<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM asistencia WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Asistencia eliminada satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Seleccione la asistencia que desea eliminar';
	}

	header('location: asistencia.php');
	
?>