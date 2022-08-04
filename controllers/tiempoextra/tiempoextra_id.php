<?php
	require_once '../../models/tiempoextra_model.php';
	$tiempoextra = new tiempoextra_model();

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $row = $tiempoextra->datos_tiempoextra($id);
        echo json_encode($row);
    }

?>