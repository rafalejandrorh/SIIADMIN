<?php 
        require_once "../models/nomina_model.php";
        $nomina = new nomina_model();

        $to = date('Y-m-d');
        $from = date('Y-m-d', strtotime('-30 day', strtotime($to)));

        if(isset($_GET['range'])){
        $range = $_GET['range'];
        $ex = explode(' - ', $range);
        $from = date('Y-m-d', strtotime($ex[0]));
        $to = date('Y-m-d', strtotime($ex[1]));
        }


        $obtener = $nomina->obtener_nomina($from, $to);

        $count = count($obtener);
        for ($x=0; $x<$count; $x++){
        $obtener;
        }
        print_r($obtener[1]);

        $avancefectivo = $nomina->avancefectivo();

        $prueba = 'hola mundo';
        // $avancefectivo = $nomina->obtener_efectivo($cedula);


?>