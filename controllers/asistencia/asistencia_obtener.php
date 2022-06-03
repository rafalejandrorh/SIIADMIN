<?php 
        require_once "../../config/conn.php";
        require_once "../../models/asistencia_model.php";
        $asistencia = new asistencia_model();

        $obtener = [];

        if(isset($_GET['range'])){
        $range = $_GET['range'];
        $ex = explode(' - ', $range);
        $from = date('Y-m-d', strtotime($ex[0]));
        $to = date('Y-m-d', strtotime($ex[1]));

        $obtener = $asistencia-> obtener_asistencia($from, $to);

}

?>