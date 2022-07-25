<?php 

require_once('../../config/conn.php');

class deducciones_model 
{

    private $db;
    private $deducciones;
    private $deducciones2;
    public $conexion;

    public function __construct()
    {
        
        $this->db = Conexion::DB_mySQL();
		$this->conexion = new Conexion;
        $this->deducciones = array();

    }

    public function obtener_deducciones($tabla)
    {

        $sql = "SELECT * FROM $tabla";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function insertar_deducciones($description, $amount, $tabla)
    {

        $sql = "INSERT INTO $tabla (description, amount) VALUES ('$description', '$amount')";
        if($this->conexion->query($sql))
        {
			$_SESSION['success'] = 'Deducciones añadidas satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $this->conexion->error;
		}
        return $_SESSION;

    }

    public function editar_deducciones($description, $amount, $id, $tabla)
    {

        $sql = "UPDATE $tabla SET description = '$description', amount = '$amount' WHERE id = '$id'";
        if($this->conexion->query($sql))
        {
			$_SESSION['success'] = 'Deducción actualizada satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $this->dberror;
		}
        return $_SESSION;

    }
    
    public function eliminar_deducciones($id, $tabla)
    {

        $sql = "DELETE FROM $tabla WHERE id = '$id'";
        if($this->conexion->query($sql))
        {
			$_SESSION['success'] = 'La Deducción se eliminó correctamente';
		}
		else{
			$_SESSION['error'] = $this->conexion->error;
		}
        return $_SESSION;

    }

}

?>
