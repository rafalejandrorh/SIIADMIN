<?php
    require_once '../../models/perfiles_model.php';
	$perfiles = new perfiles_model();

	if(isset($_POST['id']))
    {
		$id = $_POST['id'];
		$row = $perfiles->datos_perfiles($id);
		echo json_encode($row);
	}
?>