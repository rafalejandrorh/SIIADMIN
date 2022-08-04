<?php
	require_once '../../models/avancefectivo_model.php';
	$avancefectivo = new avancefectivo_model();

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $row = $avancefectivo->datos_avancefectivo($id);
        echo json_encode($row);
    }
?>