<?php 
        include "../../config/conn.php";
        require_once "../../models/deducciones_model.php";
        $deducciones = new deducciones_model();
        $obtener = $deducciones-> obtener_deducciones(); 
        $obtener2 = $deducciones-> obtener_deducciones2(); 
        
?>