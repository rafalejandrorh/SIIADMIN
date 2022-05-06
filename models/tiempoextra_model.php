<?php 

require_once "../config/conn.php";

class tiempoextra_model 
{

    private $db;
    private $tiempoextra;

    public function __construct()
    {
        
        $this->db = Conectar::conexion();
        $this->tiempoextra = array();

    }

    public function obtener_tiempoextra()
    {

        //preguntar a Ing. cual sería la alternativa en este caso

        $sql = "SELECT *, tiempoextra.id AS otid, empleados.employee_id AS empid FROM tiempoextra LEFT JOIN empleados ON empleados.id=tiempoextra.employee_id";
        $query = $this->db->query($sql);
        while($row = $query->fetch_assoc())
        {

            $this->tiempoextra[] = $row;

        }
                    $gross = $row['rate'] * $row['hours'];
                    
        return $this->tiempoextra;

    }
}

?>
