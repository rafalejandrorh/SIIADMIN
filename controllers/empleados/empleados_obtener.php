<?php 
        require_once "../../models/empleados_model.php";
        $empleados = new empleados_model();
        $obtener = $empleados->obtener_empleados();
?>