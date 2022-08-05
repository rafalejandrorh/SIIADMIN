<?php 

class nomina_model 
{

    public $conexion;

    public function __construct()
    {
        
		$this->conexion = new Conexion;
    }

    public function consulta_obtener_nomina($from, $to)
    {
        $filtro = null;
		if($from != null && $to != null)
		{
			$filtro = "WHERE asistencia.fecha BETWEEN '$from' AND '$to'";
		}
        $sql = "SELECT personas.nombres, personas.apellidos, cargos.sueldo, SUM(horas_laboradas) AS total_horas, asistencia.id_empleado 
        AS empid, personas.cedula AS ci 
        FROM asistencia 
        LEFT JOIN empleados ON empleados.id_empleado=asistencia.id_empleado 
        LEFT JOIN personas ON empleados.id_persona = personas.id_persona 
        LEFT JOIN cargos ON cargos.id_cargo=empleados.id_cargo 
        $filtro
        GROUP BY asistencia.id_empleado, personas.nombres, personas.apellidos, cargos.sueldo, personas.cedula 
        ORDER BY personas.apellidos ASC, personas.nombres ASC";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);    

    }

    public function consulta_avancefectivo($from, $to, $id_empleado)
    {
        $filtro = null;
		if($from != null && $to != null)
		{
			$filtro = "AND fecha BETWEEN '$from' AND '$to'";
		}
        $sql = "SELECT id_empleado, SUM(monto) AS efectivo FROM avancefectivo WHERE id_empleado='$id_empleado' $filtro GROUP BY avancefectivo.id_empleado";
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

    public function calculo_nomina($sueldo, $deduction, $deduction2, $deductionefectivo, $dolar)
    {

        //Cálculo de FAOV e IVSS
        $mensual = ($sueldo * 12)/52;
        $percentdeduction = $deduction * $mensual;
        $faovsso = $percentdeduction * 5;

        //Cálculo de Paro Forzoso
        $paroforzoso = $sueldo * $deduction2;

        //Suma de deducciones por ley
        $deductionley = $faovsso + $paroforzoso;

        //Suma de Deducciones por ley y Avance de Efectivo para descontar
        $total_deduction = $deductionley + $deductionefectivo;

        //Cálculo de Sueldo a cobrar, restando el total de deducciones al sueldo neto
        $neto = $sueldo - $total_deduction;

        //Cálculo de Sueldo en Dólares
        $bs = $dolar * $neto;

        return array('deductionley' => $deductionley, 'neto' => $neto, 'bs' => $bs, 'total_deduction' => $total_deduction);

    }

}
?>
