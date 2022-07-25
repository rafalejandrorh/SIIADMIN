<?php 

class nomina_model 
{

    private $db;
    private $nomina;
    public $conexion;

    public function __construct()
    {
        
        $this->db = Conexion::DB_mySQL();
		$this->conexion = new Conexion;
        $this->nomina = array();
    }

    public function consulta_obtener_nomina($from, $to)
    {

        $sql = "SELECT firstname, lastname, cargos.rate, SUM(num_hr) AS total_hr, asistencia.employee_id AS empid, empleados.employee_id AS ci FROM asistencia LEFT JOIN empleados ON empleados.id=asistencia.employee_id LEFT JOIN cargos ON cargos.position_id=empleados.position_id WHERE asistencia.date BETWEEN '$from' AND '$to' GROUP BY asistencia.employee_id ORDER BY empleados.lastname ASC, empleados.firstname ASC";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function consulta_avancefectivo($from, $to, $empid)
    {

        $sql = "SELECT *, SUM(amount) AS cashamount FROM avancefectivo WHERE employee_id='$empid' AND date_advance BETWEEN '$from' AND '$to'";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function consulta_deducciones()
    {

        $sql = "SELECT SUM(amount) as total_amount FROM deducciones";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function consulta_deducciones2()
    {

        $sql = "SELECT amount as total_amount2 FROM deducciones2";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function consulta_tasadolar()
    {
                      
        $sql = "SELECT *, rate_dolar FROM tasa_dolar";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

}
?>
