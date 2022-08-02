<?php 
	include '../../controllers/sesion/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, avancefectivo.id AS caid FROM avancefectivo LEFT JOIN empleados ON empleados.id_empleado=avancefectivo.id_empleado LEFT JOIN personas ON empleados.id_persona = personas.id_persona WHERE avancefectivo.id='$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>