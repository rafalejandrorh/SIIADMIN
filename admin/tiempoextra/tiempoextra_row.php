<?php 
	include '../../controllers/sesion/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, tiempoextra.id AS otid FROM tiempoextra LEFT JOIN empleados on empleados.id_empleado=tiempoextra.id_empleado LEFT JOIN personas ON empleados.id_persona = personas.id_persona WHERE tiempoextra.id='$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>