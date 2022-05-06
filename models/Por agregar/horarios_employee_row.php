<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, empleados.id AS empid FROM empleados LEFT JOIN horarios ON horarios.id=empleados.schedule_id WHERE empleados.id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>