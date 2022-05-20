<?php 

require_once "../config/conn.php";


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

public function avancefectivo()
    {

        $sql = "SELECT *, SUM(num_hr) AS total_hr, asistencia.employee_id AS empid FROM asistencia LEFT JOIN empleados ON empleados.id=asistencia.employee_id LEFT JOIN cargos ON cargos.position_id=empleados.position_id WHERE asistencia.date BETWEEN '2022-04-01' AND '2022-04-30' GROUP BY asistencia.employee_id ORDER BY empleados.lastname ASC, empleados.firstname ASC";
        
        $query = $this->db->query($sql);
        while($row = $query->fetch_assoc())
        {

            $empid = $row['empid'];

            $casql = "SELECT *, SUM(amount) AS cashamount FROM avancefectivo WHERE employee_id='$empid' AND date_advance BETWEEN '2022-04-01' AND '2022-04-30'";

            

        }

        return;

}

public function deducciones()
    {

        $sql = "SELECT *, SUM(num_hr) AS total_hr, asistencia.employee_id AS empid FROM asistencia LEFT JOIN empleados ON empleados.id=asistencia.employee_id LEFT JOIN cargos ON cargos.position_id=empleados.position_id WHERE asistencia.date BETWEEN '2022-04-01' AND '2022-04-30' GROUP BY asistencia.employee_id ORDER BY empleados.lastname ASC, empleados.firstname ASC";
        $query = $this->db->query($sql);
        while($row = $query->fetch_assoc())
        {
            $empid = $row['empid'];

            $sql = "SELECT *, SUM(amount) as total_amount FROM deducciones WHERE id = 5";
            $query = $this->db->query($sql);
            $drow = $query->fetch_assoc();
            $deduction = $drow['total_amount'];

            $sql2 = "SELECT *, SUM(amount) as total_amount2 FROM deducciones2";
            $query2 = $this->db->query($sql2);
            $drow2 = $query2->fetch_assoc();
            $deduction2 = $drow2['total_amount2'];

            $casql = "SELECT *, SUM(amount) AS cashamount FROM avancefectivo WHERE employee_id='$empid' AND date_advance BETWEEN '2022-04-01' AND '2022-04-30'";
                      
            $rsql = "SELECT *, rate_dolar FROM tasa_dolar";
            $rquery = $this->db->query($rsql);
            $rate_dolar = $rquery->fetch_assoc();
            $dolarbcv = $rate_dolar['rate_dolar'];

            

        }

        return;

}

}
?>
