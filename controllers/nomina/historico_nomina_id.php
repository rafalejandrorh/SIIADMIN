<?php
    require_once '../../models/nomina_model.php';
	$nomina = new nomina_model();

	if(isset($_POST['id']))
    {
		$id = $_POST['id'];
		$row = $nomina->datos_nomina($id);
		echo json_encode($row);
	}
?>