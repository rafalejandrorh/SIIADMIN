<?php
    require_once '../../models/tasadolar_model.php';
    $tasadolar = new tasadolar_model();

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $row = $tasadolar->datos_tasadolar($id);
        echo json_encode($row);
    }

?>