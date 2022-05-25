<?php 
        include "../../config/conn.php";
        require_once "../../models/avancefectivo_model.php";
        $avancefectivo = new avancefectivo_model();
        $obtener = $avancefectivo-> obtener_avancefectivo(); 
        
?>