<?php 
        include "../../config/conn.php";
        require_once "../../models/tiempoextra_model.php";
        $tiempoextra = new tiempoextra_model();
        $obtener = $tiempoextra-> obtener_tiempoextra(); 
        
?>