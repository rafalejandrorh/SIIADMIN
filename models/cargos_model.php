<?php 

require_once "../config/conn.php";

class cargos_model 
{

    private $db;
    private $cargos;

    public function __construct()
    {
        
        $this->db = Conectar::conexion();
        $this->cargos = array();

    }

    public function obtener_cargos()
    {

        //preguntar a Ing. cual sería la alternativa en este caso

        $sql = "SELECT * FROM cargos";
        $query = $this->db->query($sql);
        while($row = $query->fetch_assoc())
            
        {
            
            $this->cargos[] = $row;
            

        }
                    
        return $this->cargos;

    }

    public function insertar_cargos($title, $rate)
    {

        $sql = "INSERT INTO cargos (description, rate) VALUES ('$title', '$rate')";

		if($this->db->query($sql)){
			$_SESSION['success'] = 'Cargo añadido satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $this->db->error;
		}

        return $this->$_SESSION;

    }

    public function editar_cargos($title, $rate, $id)
    {

        $sql = "UPDATE cargos SET description = '$title', rate = '$rate' WHERE position_id = '$id'";

        if($this->db->query($sql)){
			$_SESSION['success'] = 'Cargo Actualizado Satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $this->dberror;
		}

        return $this->$_SESSION;

    }
    
    public function eliminar_cargos($id)
    {

        $sql = "DELETE FROM cargos WHERE position_id = '$id'";

        if($this->db->query($sql)){
			$_SESSION['success'] = 'Cargo eliminado satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $this->db->error;
		}

        return $this->$_SESSION;

    }
}

?>
