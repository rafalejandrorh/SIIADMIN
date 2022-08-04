<?php   
	require_once '../../models/asistencia_model.php';
	$asistencia = new asistencia_model();

	if(isset($_POST['id']))
    {
		$id = $_POST['id'];
		$row = $asistencia->datos_asistencia($id);
		echo json_encode($row);
	}
?>