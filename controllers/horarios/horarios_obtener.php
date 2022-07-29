<?php 
        require_once "../../models/horarios_model.php";
        $horarios = new horarios_model();
        $horarios = $horarios->obtener_horarios(); 

?>