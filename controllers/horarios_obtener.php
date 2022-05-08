<?php 

        require_once "../models/horarios_model.php";
        $horarios = new horarios_model();
        $obtener["titulo"] = "Horarios";
        $obtener = $horarios-> obtener_horarios(); 

?>