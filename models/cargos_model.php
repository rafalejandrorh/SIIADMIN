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

    public function insertar_cargos($cargo, $sueldo)
    {

        $sql = "INSERT INTO cargos (cargo, sueldo) VALUES ('$cargo', '$sueldo')";
		$query = $this->conexion->query($sql);
        if($query->rowCount() >= 1)
        {
			$_SESSION['success'] = 'Cargo añadido satisfactoriamente';
		}else{
			$_SESSION['error'] = 'Error al Insertar el Cargo, intente más tarde.';
		}
        return $_SESSION;

    }

    public function editar_cargos($cargo, $sueldo, $id_cargo)
    {

        $sql = "UPDATE cargos SET cargo = '$cargo', sueldo = '$sueldo' WHERE id_cargo = '$id_cargo'";
        $query = $this->conexion->query($sql);
        if($query->rowCount() >= 1)
        {
			$_SESSION['success'] = 'Cargo Actualizado Satisfactoriamente';
		}else{
			$_SESSION['error'] = 'Error al Editar el Cargo, intente más tarde.';
		}
        return $_SESSION;


    }

    public function datos_cargos($id)
	{
		$sql = "SELECT * FROM cargos WHERE id_cargo = '$id'";
		$query = $this->conexion->query($sql);
		return $query->fetch(PDO::FETCH_ASSOC);
	}
    
    public function eliminar_cargos($id_cargo)
    {

        $sql = "DELETE FROM cargos WHERE id_cargo = '$id_cargo'";
        $query = $this->conexion->query($sql);
        if($query->rowCount() >= 1)
        {

            $sql = "UPDATE FROM empleados SET id_cargo = 15 WHERE id_cargo = $id_cargo";
			$_SESSION['success'] = 'Cargo eliminado satisfactoriamente. Recuerda reasignar los Cargos a los Empleados correspondientes.';

		}else{

			$_SESSION['error'] = 'Error al Eliminar el Cargo, intente más tarde.';

		}
        return $_SESSION;

    }
}

?>
