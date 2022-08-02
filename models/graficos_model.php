<?php

class graficos_model 
{

    public $conexion;

    public function __construct()
    {
        $this->db = Conexion::DB_mySQL();
		$this->conexion = new Conexion;
    }

    public function graficos_asistencia_atiempo($year, $ontime)
    {

        $and = 'AND YEAR(fecha) = '.$year;
        for($m = 1; $m <= 12; $m++ ) {
            $sql = "SELECT * FROM asistencia WHERE MONTH(fecha) = '$m' AND estatus_llegada = 1 $and";
            $oquery = $this->conexion->query($sql);
            array_push($ontime, $oquery->rowCount());
        }
        return $ontime;

    }

    public function graficos_asistencia_tarde($year, $late)
    {

        $and = 'AND YEAR(fecha) = '.$year;
        for($m = 1; $m <= 12; $m++ ) {
            $sql = "SELECT * FROM asistencia WHERE MONTH(fecha) = '$m' AND estatus_llegada = 0 $and";
            $lquery = $this->conexion->query($sql);
            array_push($late, $lquery->rowCount());
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
}

?>    