<?php
    require_once '../../models/usuarios_model.php';
	$usuarios = new usuarios_model();

	if(isset($_POST['id']))
    {
		$id = $_POST['id'];
		$row = $usuarios->datos_usuarios($id);
		echo json_encode($row);
	}
?>