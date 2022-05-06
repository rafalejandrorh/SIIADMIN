<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$time_in = $_POST['time_in'];
		$time_in = date('H:i:s', strtotime($time_in));
		$time_out = $_POST['time_out'];
		$time_out = date('H:i:s', strtotime($time_out));

		$sql = "UPDATE horarios SET time_in = '$time_in', time_out = '$time_out' WHERE schedule_id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Horarios actualizados satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Intenta actualizar los horarios nuevamente';
	}

	header('location:horarios.php');

?>