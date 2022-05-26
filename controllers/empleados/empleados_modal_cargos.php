<?php 
        include "../../config/conn.php";
        require_once "../../models/cargos_model.php";
        $cargos = new cargos_model();
        $cargos_añadir = $cargos-> obtener_cargos(); 
        $cargos_editar = $cargos-> obtener_cargos(); 
        
?>