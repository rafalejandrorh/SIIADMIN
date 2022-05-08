<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, empleados.id AS empid FROM empleados LEFT JOIN cargos ON cargos.position_id=empleados.position_id LEFT JOIN horarios ON horarios.schedule_id=empleados.schedule_id WHERE empleados.id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>