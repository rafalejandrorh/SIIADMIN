<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$title = $_POST['title'];
		$rate = $_POST['rate'];

		$sql = "UPDATE cargos SET description = '$title', rate = '$rate' WHERE position_id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Cargo Actualizado Satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Rellene el formulario de edición primero';
	}

	header('location:cargos.php');

?>