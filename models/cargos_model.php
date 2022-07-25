<?php 

require_once('../../config/conn.php');

class cargos_model 
{

    private $db;
    private $cargos;
    public $conexion;

    public function __construct()
    {
        
        $this->db = Conexion::DB_mySQL();
		$this->conexion = new Conexion;
        $this->cargos = array();

    }

    public function obtener_cargos()
    {

        $sql = "SELECT * FROM cargos";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function insertar_cargos($title, $rate)
    {

        $sql = "INSERT INTO cargos (description, rate) VALUES ('$title', '$rate')";
		if($this->conexion->query($sql))
        {
			$_SESSION['success'] = 'Cargo añadido satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $this->conexion->error;
		}
        return $_SESSION;

    }

    public function editar_cargos($title, $rate, $id)
    {

        $sql = "UPDATE cargos SET description = '$title', rate = '$rate' WHERE position_id = '$id'";
        if($this->conexion->query($sql))
        {
			$_SESSION['success'] = 'Cargo Actualizado Satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $this->dberror;
		}
        return $_SESSION;

    }
    
    public function eliminar_cargos($id)
    {

        $sql = "DELETE FROM cargos WHERE position_id = '$id'";
        if($this->conexion->query($sql))
        {
			$_SESSION['success'] = 'Cargo eliminado satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $this->conexion->error;
		}
        return $_SESSION;

    }
}

?>
