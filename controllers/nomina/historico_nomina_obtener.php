<?php
        require_once "../../config/conn.php";
        require_once "../../models/nomina_model.php";
        $nomina = new nomina_model();

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

        //Obtiene los Empleados, sus horas trabajadas y el monto a cobrar por esas horas
        $obtener_historico_nomina = $nomina->obtener_historico_nomina($from, $to);      

?>