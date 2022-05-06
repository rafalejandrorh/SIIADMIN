<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM cargos WHERE position_id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Cargo eliminado satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Seleccione el cargo que desea eliminar';
	}

	header('location: cargos.php');
	
?>