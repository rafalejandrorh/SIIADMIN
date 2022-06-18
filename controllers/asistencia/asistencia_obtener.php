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

        $time_in = new DateTime('07:00:00');
	$time_out = new DateTime('18:00:00');
	$interval = $time_in->diff($time_out);
	$hrs = $interval->format('%h');
	$mins = $interval->format('%i');
	$mins = $mins/60;
	$int = $hrs + $mins;
	if($int > 4){
		$int = $int - 1;
	}

        print_r($int);
}

?>