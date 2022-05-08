<?php 
        require_once "../models/asistencia_model.php";
        $empleados = new asistencia_model();
        $obtener = $empleados-> obtener_asistencia();

?>