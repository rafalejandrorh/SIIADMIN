<?php 

require_once "../config/conn.php";

class empleados_model 
{

    private $db;
    private $empleados;

    public function __construct()
    {
        
        $this->db = Conectar::conexion();
        $this->empleados = array();

    }

    public function obtener_empleados()
    {

        $sql = "SELECT *, empleados.id AS empid FROM empleados LEFT JOIN cargos ON cargos.position_id=empleados.position_id LEFT JOIN horarios ON horarios.schedule_id=empleados.schedule_id";
        $query = $this->db->query($sql);
        while($row = $query->fetch_assoc())
        {

            $this->empleados[] = $row;

        }

        return $this->empleados;

    }

    public function insertar_empleados()
    {

        $sql = "SELECT *, empleados.id AS empid FROM empleados LEFT JOIN cargos ON cargos.position_id=empleados.position_id LEFT JOIN horarios ON horarios.schedule_id=empleados.schedule_id";
        $query = $this->db->query($sql);
        while($row = $query->fetch_assoc())
        {

            $this->empleados[] = $row;

        }

        return $this->empleados;

    }
}

?>
