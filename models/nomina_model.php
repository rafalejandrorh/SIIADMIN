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

    public function obtener_nomina()
    {

        $sql = "SELECT *, SUM(num_hr) AS total_hr, asistencia.employee_id AS empid FROM asistencia LEFT JOIN empleados ON empleados.id=asistencia.employee_id LEFT JOIN cargos ON cargos.position_id=empleados.position_id WHERE asistencia.date BETWEEN '2022-04-01' AND '2022-04-30' GROUP BY asistencia.employee_id ORDER BY empleados.lastname ASC, empleados.firstname ASC";
        $query = $this->db->query($sql);
        while($row = $query->fetch_assoc())
        {
            $empid = $row['empid'];

            $sql = "SELECT *, SUM(amount) as total_amount FROM deducciones";
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

            /*$string = file_get_contents("https://s3.amazonaws.com/dolartoday/data.json");
            $json = json_decode($string, true);
            $dolarbcv = $json["USD"]["promedio_real"];*/

            $caquery = $this->db->query($casql);
            $carow = $caquery->fetch_assoc();
            $cashadvance = $carow['cashamount'];

            $gross = $row['rate'] * $row['total_hr'];
            $mensualgross = ($gross * 12)/52;
            $percentdeduction = $deduction * $mensualgross;
            $faovsso = $percentdeduction * 5;

            $gross2 = $row['rate'] * $row['total_hr'];
            $paroforzoso = $gross2 * $deduction2;

            $deductionley = $faovsso + $paroforzoso;

            $total_deduction =  $deductionley + $cashadvance;
            $net = $gross - $total_deduction;
            $bs = $dolarbcv * $net; 

            $this->nomina[] = $row;

        }

        return $this->nomina;

}

}
?>
