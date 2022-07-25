<?php 
        require_once "../../config/conn.php";
        require_once "../../models/empleados_model.php";
        require_once "../../models/asistencia_model.php";

        $empleados = new empleados_model();
        $total_empleados = $empleados->obtener_total_empleados();

        $asistentes = new asistencia_model();
        
        $asistentes_atiempo = $asistentes->asistentes_atiempo();
        $asistentes_tarde = $asistentes->asistentes_tarde();

        $asistentes_atiempo_hoy = $asistentes->asistentes_atiempo_hoy();
        $asistentes_tarde_hoy = $asistentes->asistentes_tarde_hoy();
?>