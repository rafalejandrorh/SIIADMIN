<?php 

        require_once "../../models/cargos_model.php";
        require_once "../../models/horarios_model.php";
        $cargos = new cargos_model();
        $horarios = new horarios_model();
        $cargos= $cargos-> obtener_cargos(); 
        $horarios = $horarios-> obtener_horarios(); 
        
?>