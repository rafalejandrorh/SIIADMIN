<?php

require_once('../../config/conn.php');

class graficos_model 
{

    public $conexion;

    public function __construct()
    {
		$this->conexion = new Conexion;
    }

    public function graficos_asistencia_atiempo($year, $ontime)
    {

        $and = 'AND EXTRACT(YEAR FROM fecha) = '.$year;
        for($m = 1; $m <= 12; $m++ ) {
            $sql = "SELECT * FROM public.asistencia WHERE EXTRACT(MONTH FROM fecha) = '$m' AND estatus_llegada = 1 $and";
            $query = $this->conexion->query($sql);
            array_push($ontime, $query->rowCount());
        }
        return $ontime;

    }

    public function graficos_asistencia_tarde($year, $late)
    {

        $and = 'AND EXTRACT(YEAR FROM fecha) = '.$year;
        for($m = 1; $m <= 12; $m++ ) {
            $sql = "SELECT * FROM public.asistencia WHERE EXTRACT(MONTH FROM fecha) = '$m' AND estatus_llegada = 0 $and";
            $query = $this->conexion->query($sql);
            array_push($late, $query->rowCount());
        }
        return $late;

    }

    public function graficos_asistencia_meses($months)
    {

        for($m = 1; $m <= 12; $m++ ) {
            $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
            $month =  date('M', mktime(0, 0, 0, $m, 1));  
            array_push($months, $month);
        }
        return $months;
        
    }

    public function graficos_conexiones_iniciadas($year, $conexiones)
    {

        $and = 'AND EXTRACT(YEAR FROM inicio_sesion) = '.$year;
        for($m = 1; $m <= 12; $m++ ) {
            $sql = "SELECT * FROM public.historial_sesion WHERE EXTRACT(MONTH FROM inicio_sesion) = '$m' $and";
            $query = $this->conexion->query($sql);
            array_push($conexiones, $query->rowCount());
        }
        return $conexiones;

    }

    public function graficos_conexiones_finalizadas($year, $conexiones)
    {

        $and = 'AND EXTRACT(YEAR FROM cierre_sesion) = '.$year;
        for($m = 1; $m <= 12; $m++ ) {
            $sql = "SELECT * FROM public.historial_sesion WHERE EXTRACT(MONTH FROM cierre_sesion) = '$m' $and";
            $query = $this->conexion->query($sql);
            array_push($conexiones, $query->rowCount());
        }
        return $conexiones;

    }

}

?>    