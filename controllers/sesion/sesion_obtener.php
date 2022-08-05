<?php 
        require_once "../../models/sesion_model.php";
        $sesion = new sesion_model();
        $obtener = $sesion->obtener_historial();
?>