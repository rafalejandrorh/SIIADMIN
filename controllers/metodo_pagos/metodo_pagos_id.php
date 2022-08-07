<?php
    require_once '../../models/empleados_model.php';
	$empleados = new empleados_model();

	if(isset($_POST['id']))
    {
		$id = $_POST['id'];
		$row = $empleados->datos_empleados($id);
		echo json_encode($row);
	}
?>