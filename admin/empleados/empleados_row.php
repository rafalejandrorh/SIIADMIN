<?php 
	include '../../controllers/sesion/session.php';
	// require_once "../../config/conn.php";
	// require_once '../../models/empleados_model.php';
	// $empleados = new empleados_model();

	if(isset($_POST['id'])){
		$id_empleado = $_POST['id'];
		$sql = "SELECT personas.nombres, personas.apellidos, personas.direccion, personas.fecha_nacimiento, personas.numero_contacto,
		personas.genero, cargos.id_cargo, cargos.cargo, horarios.id_horarios, horarios.hora_llegada, horarios.hora_salida, 
		personas.foto, personas.cedula, empleados.id_empleado
		FROM empleados 
		LEFT JOIN cargos ON cargos.id_cargo=empleados.id_cargo 
		LEFT JOIN horarios ON horarios.id_horarios=empleados.id_horarios 
		LEFT JOIN personas ON empleados.id_persona = personas.id_persona 
		WHERE empleados.id_empleado = '$id_empleado'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();
		echo json_encode($row);
		//$row = $empleados->obtener_empleado(1);
		//print_r($row);
	}

	

?>