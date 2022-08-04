<?php
    require_once '../../models/horarios_model.php';
    $horarios = new horarios_model();

	if(isset($_POST['id'])){
		$id = $_POST['id'];
        $row = $horarios->datos_horarios($id);
		echo json_encode($row);
	}
?>