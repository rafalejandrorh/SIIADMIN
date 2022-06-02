<?php 

class nomina_model 
{

    private $db;
    private $nomina;

    public function __construct()
    {
        
        $this->db = Conectar::conexion();
        $this->nomina = array();
    }

public function obtener_nomina($from, $to)
    {

        $sql = "SELECT *, SUM(num_hr) AS total_hr, asistencia.employee_id AS empid FROM asistencia LEFT JOIN empleados ON empleados.id=asistencia.employee_id LEFT JOIN cargos ON cargos.position_id=empleados.position_id WHERE asistencia.date BETWEEN '$from' AND '$to' GROUP BY asistencia.employee_id ORDER BY empleados.lastname ASC, empleados.firstname ASC";
        $query = $this->db->query($sql);
        while($row = $query->fetch_assoc())
        {

            $this->nomina[] = $row;

        }

        return $this->nomina;

    }

public function avancefectivo($from, $to, $empid)
    {

            $casql = "SELECT *, SUM(amount) AS cashamount FROM avancefectivo WHERE employee_id='$empid' AND date_advance BETWEEN '$from' AND '$to'";
            $caquery = $this->db->query($casql);
            $carow = $caquery->fetch_assoc();

            $this->avancefectivo[] = $carow;

            return $this->avancefectivo;

    }

public function deducciones()
    {

            $sql = "SELECT SUM(amount) as total_amount FROM deducciones";
            $query = $this->db->query($sql);
            $drow = $query->fetch_assoc();

            $this->deducciones[] = $drow;

        return $this->deducciones;

    }

public function deducciones2()
    {

            $sql2 = "SELECT amount as total_amount2 FROM deducciones2";
            $query2 = $this->db->query($sql2);
            $drow2 = $query2->fetch_assoc();
            
            $this->deducciones2[] = $drow2;

            $this->deducciones2;

        return $this->deducciones2;

    }

public function tasadolar()
    {
                      
            $rsql = "SELECT *, rate_dolar FROM tasa_dolar";
            $rquery = $this->db->query($rsql);
            $rate_dolar = $rquery->fetch_assoc();

            $this->tasadolar[] = $rate_dolar;

        return $this->tasadolar;

    }

}
?>
