<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$employee = $_POST['employee'];
		$date = $_POST['date'];
		$hours = $_POST['hours'];
		$rate = $_POST['rate'];
		$sql = "SELECT * FROM empleados WHERE employee_id = '$employee'";
		$query = $conn->query($sql);
		if($query->num_rows < 1){
			$_SESSION['error'] = 'Empleado no encontrado';
		}
		else{
			$row = $query->fetch_assoc();
			$employee_id = $row['id'];
			$sql = "INSERT INTO tiempoextra (employee_id, date_overtime, hours, rate) VALUES ('$employee_id', '$date', '$hours', '$rate')";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Tiempo extra añadido satisfactoriamente';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
	}	
	else{
		$_SESSION['error'] = 'Intenta agregar el tiempo extra nuevamente';
	}

	header('location: tiempoextra.php');

?>