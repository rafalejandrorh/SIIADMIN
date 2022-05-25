<?php 
        include "../../config/conn.php";
        require_once "../../models/cargos_model.php";
        $cargos = new cargos_model();
        $obtener = $cargos-> obtener_cargos(); 
        
?>