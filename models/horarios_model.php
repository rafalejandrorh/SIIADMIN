<?php 

require_once "../config/conn.php";

class horarios_model 
{

    private $db;
    private $horarios;

    public function __construct()
    {
        
        $this->db = Conectar::conexion();
        $this->horarios = array();

    }

    public function obtener_horarios()
    {

        $sql = "SELECT *, horarios FROM horarios";
        $query = $this->db->query($sql);
        while($row = $query->fetch_assoc())
        {

            $this->horarios[] = $row;

        }

        return $this->horarios;

    }
}

?>
