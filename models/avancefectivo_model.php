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

        $sql = "SELECT *, avancefectivo.id AS caid, empleados.employee_id AS empid FROM avancefectivo LEFT JOIN empleados ON empleados.id=avancefectivo.employee_id";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function insertar_avancefectivo($employee, $amount)
    {

        $sql = "SELECT * FROM empleados WHERE employee_id = '$employee'";
		$query = $this->conexion->query($sql);
		if($query->rowCount() < 1)
        {
			$_SESSION['error'] = 'Empleado no encontrado';
		}
		else{
			$row = $query->fetch();
			$employee_id = $row['id'];
			$sql = "INSERT INTO avancefectivo (employee_id, date_advance, amount) VALUES ('$employee_id', NOW(), '$amount')";
			if($this->conexion->query($sql))
            {
				$_SESSION['success'] = 'Avance de Efectivo añadido satisfactoriamente';
			}
			else{
				$_SESSION['error'] = $this->conexion->error;
			}
        }
        return $_SESSION;

    }

    public function editar_avancefectivo($amount, $id)
    {

        $sql = "UPDATE avancefectivo SET amount = '$amount' WHERE id = '$id'";
        if($this->conexion->query($sql))
        {
			$_SESSION['success'] = 'Avance de Efectivo actualizado satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $this->dberror;
		}
        return $_SESSION;

    }
    
    public function eliminar_avancefectivo($id)
    {

        $sql = "DELETE FROM avancefectivo WHERE id = '$id'";
        if($this->conexion->query($sql))
        {
			$_SESSION['success'] = 'Adelanto de efectivo eliminado con éxito';
		}
		else{
			$_SESSION['error'] = $this->conexion->error;
		}
        return $_SESSION;

    }
}

?>
