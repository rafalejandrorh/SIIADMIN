<?php 
        require_once "../models/asistencia_model.php";
        $asistencia = new asistencia_model();
        $obtener = $asistencia-> obtener_asistencia();

?>