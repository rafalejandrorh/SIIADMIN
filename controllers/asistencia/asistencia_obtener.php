<?php 
        require_once "../../config/conn.php";
        require_once "../../models/asistencia_model.php";
        $asistencia = new asistencia_model();

        $obtener = [];

        $from = null;
        $to = null;

        if(isset($_GET['range']))
        {
                $range = $_GET['range'];
                $ex = explode(' - ', $range);
                $from = date('Y-m-d', strtotime($ex[0]));
                $to = date('Y-m-d', strtotime($ex[1]));
        }

        if(isset($_POST['date_range']))
        {
                $range = $_POST['date_range'];
                $ex = explode(' - ', $range);
                $from = date('Y-m-d', strtotime($ex[0]));
                $to = date('Y-m-d', strtotime($ex[1]));
                $from_title = date('M d, Y', strtotime($ex[0]));
	        $to_title = date('M d, Y', strtotime($ex[1]));
        }

        $obtener = $asistencia->obtener_asistencia($from, $to);

?>