<?php 
        require_once "../../config/conn.php";
        require_once "../../models/horarios_model.php";
        $horarios = new horarios_model();
        $obtener = $horarios-> obtener_horarios(); 

?>