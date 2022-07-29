<?php 
        require_once "../../models/cargos_model.php";
        $cargos = new cargos_model();
        $cargos = $cargos->obtener_cargos();    
?>