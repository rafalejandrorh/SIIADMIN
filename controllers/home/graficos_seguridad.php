<?php 
        include '../../admin/includes/timezone.php'; 
        require_once "../../models/graficos_model.php";
        //require_once "../../models/sesion_model.php";
        //require_once "../../models/usuarios_model.php";
        $graficos = new graficos_model();

        $year = date('Y');
        if(isset($_GET['year'])){
                $year = $_GET['year'];
        }

        $months = array();
        $conexion = array();
        $conexiones = array();
        
        $conexiones_iniciadas = $graficos->graficos_conexiones_iniciadas($year, $conexion);
        $conexiones_finalizadas = $graficos->graficos_conexiones_finalizadas($year, $conexiones);
        $grafico_meses = $graficos->graficos_asistencia_meses($months);

        $months = json_encode($grafico_meses);
        $conexion_finalizadas = json_encode($conexiones_finalizadas);
        $conexion_iniciadas = json_encode($conexiones_iniciadas);
?>