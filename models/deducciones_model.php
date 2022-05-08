<?php 

require_once "../config/conn.php";

class deducciones_model 
{

    private $db;
    private $deducciones;
    private $deducciones2;

    public function __construct()
    {
        
        $this->db = Conectar::conexion();
        $this->deducciones = array();

    }

    public function obtener_deducciones()
    {

        //preguntar a Ing. cual sería la alternativa en este caso

        $sql = "SELECT * FROM deducciones";
        $query = $this->db->query($sql);
        while($row = $query->fetch_assoc())
            
        {
            
            $this->deducciones[] = $row;
            

        }
                    
        return $this->deducciones;

    }

    public function obtener_deducciones2()
    {

        //preguntar a Ing. cual sería la alternativa en este caso

        $sql = "SELECT * FROM deducciones2";
        $query = $this->db->query($sql);
        while($row = $query->fetch_assoc())
            
        {
            
            $this->deducciones2[] = $row;
            

        }
                    
        return $this->deducciones2;

    }

    public function insertar_deducciones($description, $amount)
    {

        $sql = "INSERT INTO deducciones (description, amount) VALUES ('$description', '$amount')";

        if($this->db->query($sql)){
			$_SESSION['success'] = 'Deducciones añadidas satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $this->db->error;
		}

        return $this->$_SESSION;

    }

    public function insertar_deducciones2($description, $amount)
    {

        $sql = "INSERT INTO deducciones2 (description, amount) VALUES ('$description', '$amount')";

        if($this->db->query($sql)){
			$_SESSION['success'] = 'Deducciones añadidas satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $this->db->error;
		}

        return $this->$_SESSION;

    }

    public function editar_deducciones($description, $amount, $id)
    {

        $sql = "UPDATE deducciones SET description = '$description', amount = '$amount' WHERE id = '$id'";

        if($this->db->query($sql)){
			$_SESSION['success'] = 'Deducción actualizada satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $this->dberror;
		}

        return $this->$_SESSION;

    }

    public function editar_deducciones2($description, $amount, $id)
    {

        $sql = "UPDATE deducciones2 SET description = '$description', amount = '$amount' WHERE id = '$id'";

        if($this->db->query($sql)){
			$_SESSION['success'] = 'Deducción actualizada satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $this->dberror;
		}

        return $this->$_SESSION;

    }
    
    public function eliminar_deducciones($id)
    {

        $sql = "DELETE FROM deducciones WHERE id = '$id'";

        if($this->db->query($sql)){
			$_SESSION['success'] = 'La Deducción se eliminó correctamente';
		}
		else{
			$_SESSION['error'] = $this->db->error;
		}

        return $this->$_SESSION;

    }

    public function eliminar_deducciones2($id)
    {

        $sql = "DELETE FROM deducciones2 WHERE id = '$id'";

        if($this->db->query($sql)){
			$_SESSION['success'] = 'La Deducción se eliminó correctamente';
		}
		else{
			$_SESSION['error'] = $this->db->error;
		}

        return $this->$_SESSION;

    }
}

?>
