<?php 
        include "../../config/conn.php";
        require_once "../../models/tasadolar_model.php";
        $tasadolar = new tasadolar_model();
        $obtener = $tasadolar->obtener_tasadolar(); 
        
?>