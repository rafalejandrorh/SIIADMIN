<?php 
	include '../../controllers/sesion/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, asistencia.id as attid FROM asistencia LEFT JOIN empleados ON empleados.id_empleado=asistencia.id_empleado LEFT JOIN personas ON empleados.id_persona = personas.id_persona WHERE asistencia.id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>