<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM horarios WHERE schedule_id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Horario eliminado exitosamente';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Selecciona el horario e intenta eliminarlo nuevamente';
	}

	header('location: horarios.php');
	
?>