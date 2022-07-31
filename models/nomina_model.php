<?php 

class nomina_model 
{

    public $conexion;

    public function __construct()
    {
        
        $this->db = Conexion::DB_mySQL();
		$this->conexion = new Conexion;
    }

    public function consulta_obtener_nomina($from, $to)
    {

        $sql = "SELECT firstname, lastname, cargos.rate, SUM(num_hr) AS total_hr, asistencia.employee_id AS empid, empleados.employee_id AS ci FROM asistencia LEFT JOIN empleados ON empleados.id=asistencia.employee_id LEFT JOIN cargos ON cargos.position_id=empleados.position_id WHERE asistencia.date BETWEEN '$from' AND '$to' GROUP BY asistencia.employee_id ORDER BY empleados.lastname ASC, empleados.firstname ASC";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);    

    }

    public function consulta_avancefectivo($from, $to, $empid)
    {

        $sql = "SELECT employee_id, SUM(amount) AS cashamount FROM avancefectivo WHERE employee_id='$empid' AND date_advance BETWEEN '$from' AND '$to'";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function consulta_deducciones()
    {

        $sql = "SELECT SUM(amount) as total_amount FROM deducciones";
        $query = $this->conexion->query($sql);
        return $query->fetch(PDO::FETCH_ASSOC);

    }

    public function consulta_deducciones2()
    {

        $sql = "SELECT amount as total_amount2 FROM deducciones2";
        $query = $this->conexion->query($sql);
        return $query->fetch(PDO::FETCH_ASSOC);

    }

    public function consulta_tasadolar()
    {
                      
        $sql = "SELECT *, rate_dolar FROM tasa_dolar";
        $query = $this->conexion->query($sql);
        return $query->fetch(PDO::FETCH_ASSOC);

    }

    public function calculo_nomina($gross, $deduction, $deduction2, $deductionefectivo, $dolar)
    {

        //Cálculo de FAOV e IVSS
        $mensualgross = ($gross * 12)/52;
        $percentdeduction = $deduction * $mensualgross;
        $faovsso = $percentdeduction * 5;

        //Cálculo de Paro Forzoso
        $paroforzoso = $gross * $deduction2;

        //Suma de deducciones por ley
        $deductionley = $faovsso + $paroforzoso;

        //Suma de Deducciones por ley y Avance de Efectivo para descontar
        $total_deduction = $deductionley + $deductionefectivo;

        //Cálculo de Sueldo a cobrar, restando el total de deducciones al sueldo neto
        $net = $gross - $total_deduction;

        //Cálculo de Sueldo en Dólares
        $bs = $dolar * $net;

        return array('deductionley' => $deductionley, 'net' => $net, 'bs' => $bs, 'total_deduction' => $total_deduction);

    }

}
?>
