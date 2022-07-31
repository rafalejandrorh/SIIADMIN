<?php 
        require_once "../../config/conn.php";
        require_once "../../models/graficos_model.php";
        include '../../admin/includes/timezone.php'; 
        $graficos = new graficos_model();

        $year = date('Y');
        if(isset($_GET['year'])){
                $year = $_GET['year'];
        }

        $months = array();
        $ontime = array();
        $late = array();
        
        $graficos_atiempo = $graficos->graficos_asistencia_atiempo($year, $ontime);
        $graficos_tarde = $graficos->graficos_asistencia_tarde($year, $late);
        $grafico_meses = $graficos->graficos_asistencia_meses($months);

        $months = json_encode($grafico_meses);
        $late = json_encode($graficos_tarde);
        $ontime = json_encode($graficos_atiempo);
?>