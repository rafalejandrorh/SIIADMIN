<?php
	require_once '../../models/deducciones_model.php';
	$deducciones = new deducciones_model();

    if(isset($_POST['id']))
	{
		$id = $_POST['id'];
        $tabla = 'deducciones';
		$row = $deducciones->datos_deducciones($id, $tabla);
		echo json_encode($row);
	}

    if(isset($_POST['id2']))
	{
		$id = $_POST['id2'];
        $tabla = 'deducciones2';
		$row = $deducciones->datos_deducciones($id, $tabla);
		echo json_encode($row);
	}
?>