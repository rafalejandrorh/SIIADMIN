<?php 

        include "../../config/conn.php";
        require_once "../../models/deducciones_model.php";
        $deducciones = new deducciones_model();
        $tabla_ivss = 'deducciones';
        $tabla_faov = 'deducciones2';
        $obtener_ivss = $deducciones->obtener_deducciones($tabla_ivss); 
        $obtener_faov = $deducciones->obtener_deducciones($tabla_faov);
        
?>