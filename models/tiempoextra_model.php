<?php 

require_once('../../config/conn.php');

class tiempoextra_model 
{

    private $db;
    private $tiempoextra;
    public $conexion;

    public function __construct()
    {
        
        $this->db = Conexion::DB_mySQL();
        $this->conexion = new Conexion;
        $this->tiempoextra = array();

    }

    public function obtener_tiempoextra()
    {

        $sql = "SELECT *, tiempoextra.id AS otid FROM tiempoextra LEFT JOIN empleados ON empleados.id=tiempoextra.employee_id";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function insertar_tiempoextra($employee, $date, $hours, $rate)
    {

        $sql = "SELECT * FROM empleados WHERE employee_id = '$employee'";
        $query = $this->conexion->query($sql);

        if($query->rowCount() < 1)
        {
			$_SESSION['error'] = 'Empleado no encontrado';
		}else{
        $row = $query->fetch();
	    $employee_id = $row['id'];
        $sql2 = "INSERT INTO tiempoextra (employee_id, date_overtime, hours, rate) VALUES ('$employee_id', '$date', '$hours', '$rate')";
            if($this->conexion->query($sql2)){
                $_SESSION['success'] = 'Tiempo extra añadido satisfactoriamente';
            }
            else{
                $_SESSION['error'] = $this->conexion->error;
            }
        }
        return $_SESSION;

    }

    public function editar_tiempoextra($date, $hours, $rate, $id)
    {

        $sql = "UPDATE tiempoextra SET hours = '$hours', rate = '$rate', date_overtime = '$date' WHERE id = '$id'";
        if($this->conexion->query($sql))
        {
			$_SESSION['success'] = 'Tiempo extra actualizado satisfactoriamente';
		}else{
			$_SESSION['error'] = $this->conexion->error;
		}
        return $_SESSION;

    }
    
    public function eliminar_tiempoextra($id)
    {

        $sql = "DELETE FROM tiempoextra WHERE id = '$id'";
        if($this->conexion->query($sql)){
			$_SESSION['success'] = 'El tiempo extra se eliminó correctamente';
		}
		else{
			$_SESSION['error'] = $this->conexion->error;
		}
        return $_SESSION;

    }
}

?>
