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

        $sql = "SELECT personas.nombres, personas.apellidos, cargos.sueldo, SUM(horas_laboradas) AS total_horas, asistencia.id_empleado AS empid, personas.cedula AS ci FROM asistencia LEFT JOIN empleados ON empleados.id_empleado=asistencia.id_empleado LEFT JOIN personas ON empleados.id_persona = personas.id_persona LEFT JOIN cargos ON cargos.id_cargo=empleados.id_cargo WHERE asistencia.fecha BETWEEN '$from' AND '$to' GROUP BY asistencia.id_empleado ORDER BY personas.apellidos ASC, personas.nombres ASC";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);    

    }

    public function consulta_avancefectivo($from, $to, $id_empleado)
    {

        $sql = "SELECT id_empleado, SUM(monto) AS efectivo FROM avancefectivo WHERE id_empleado='$id_empleado' AND fecha BETWEEN '$from' AND '$to'";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function consulta_deducciones()
    {

        $sql = "SELECT SUM(monto) as total_monto FROM deducciones";
        $query = $this->conexion->query($sql);
        return $query->fetch(PDO::FETCH_ASSOC);

    }

    public function consulta_deducciones2()
    {

        $sql = "SELECT monto as total_monto FROM deducciones2";
        $query = $this->conexion->query($sql);
        return $query->fetch(PDO::FETCH_ASSOC);

    }

    public function consulta_tasadolar()
    {
                      
        $sql = "SELECT *, tasa_dolar FROM tasa_dolar";
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
