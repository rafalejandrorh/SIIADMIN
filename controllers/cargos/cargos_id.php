<?php 
	require_once '../../models/cargos_model.php';
	$cargos = new cargos_model();

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$row = $cargos->datos_cargos($id);
        echo json_encode($row);
	}

?>