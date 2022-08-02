<?php 

require_once('../../config/conn.php');

class avancefectivo_model 
{

    private $db;
    private $avancefectivo;
    public $conexion;

    public function __construct()
    {
        $this->db = Conexion::DB_mySQL();
		$this->conexion = new Conexion;
        $this->avancefectivo = array();
    }

    public function obtener_avancefectivo()
    {

        $sql = "SELECT *, avancefectivo.id AS caid, personas.cedula AS ci FROM avancefectivo LEFT JOIN empleados ON empleados.id_empleado=avancefectivo.id_empleado LEFT JOIN personas ON empleados.id_persona = personas.id_persona";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function insertar_avancefectivo($id_empleado, $monto)
    {

		$sql = "INSERT INTO avancefectivo (id_empleado, fecha, monto) VALUES ('$id_empleado', NOW(), '$monto')";
		$query = $this->conexion->query($sql);
        if($query->rowCount() >= 1)
        {
			$_SESSION['success'] = 'Avance de Efectivo añadido satisfactoriamente';
		}else{
			$_SESSION['error'] = 'Error al intentar Insertar el avance de efectivo, intente más tarde.';
		}

    }

    public function editar_avancefectivo($monto, $id)
    {

        $sql = "UPDATE avancefectivo SET monto = '$monto' WHERE id = '$id'";
        $query = $this->conexion->query($sql);
		$_SESSION['success'] = 'Avance de Efectivo actualizado satisfactoriamente';

    }
    
    public function eliminar_avancefectivo($id)
    {

        $sql = "DELETE FROM avancefectivo WHERE id = '$id'";
        if($this->conexion->query($sql))
        {
			$_SESSION['success'] = 'Adelanto de efectivo eliminado con éxito';
		}else{
			$_SESSION['error'] = 'Error al intentar Eliminar el avance de efectivo, intente más tarde.';
		}

    }
}

?>
