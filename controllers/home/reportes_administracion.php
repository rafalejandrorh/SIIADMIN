<?php 
        require_once "../../models/empleados_model.php";
        require_once "../../models/asistencia_model.php";

        $empleados = new empleados_model();
        $total_empleados = $empleados->obtener_total_empleados();
        $empleados_nuevo_ingreso = $empleados->obtener_empleados_nuevo_ingreso();
        $empleados_egreso = $empleados->obtener_empleados_egreso();

        $asistentes = new asistencia_model();
        $asistentes_atiempo = $asistentes->asistentes_atiempo();
        $asistentes_tarde = $asistentes->asistentes_tarde();
        $asistentes_atiempo_hoy = $asistentes->asistentes_atiempo_hoy();
        $asistentes_tarde_hoy = $asistentes->asistentes_tarde_hoy();
        $asistentes_hoy = $asistentes->asistentes_hoy();
?>