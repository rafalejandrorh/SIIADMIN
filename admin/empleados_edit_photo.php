<?php
	include 'includes/session.php';

	if(isset($_POST['upload'])){
		$empid = $_POST['id'];
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
		
		$sql = "UPDATE empleados SET photo = '$filename' WHERE employee_id = '$empid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'La foto de tu empleado fue actualizada satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Selecciona el empleado al que deseas actualizar su foto';
	}

	header('location: empleados.php');
?>