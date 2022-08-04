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

        $sql = "SELECT *, tiempoextra.id AS otid FROM tiempoextra LEFT JOIN empleados ON empleados.id_empleado=tiempoextra.id_empleado LEFT JOIN personas ON empleados.id_persona = personas.id_persona";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function insertar_tiempoextra($id_empleado, $fecha, $horas, $monto)
    {

        $sql = "INSERT INTO tiempoextra (id_empleado, fecha, horas, monto) VALUES ('$id_empleado', '$fecha', '$horas', '$monto')";
        $query = $this->conexion->query($sql);
        if($query->rowCount() >= 1)
        {
                $_SESSION['success'] = 'Tiempo extra añadido satisfactoriamente';
        }else{
                $_SESSION['error'] = 'Error al insertar el Tiempo extra, intente más tarde.';
        }

    }

    public function editar_tiempoextra($fecha, $horas, $monto, $id)
    {

        $sql = "UPDATE tiempoextra SET horas = '$horas', monto = '$monto', fecha = '$fecha' WHERE id = '$id'";
        $query = $this->conexion->query($sql);
		$_SESSION['success'] = 'Tiempo extra actualizado satisfactoriamente';

    }
    
    public function datos_tiempoextra($id)
	{
		$sql = "SELECT *, tiempoextra.id AS otid FROM tiempoextra 
        LEFT JOIN empleados on empleados.id_empleado=tiempoextra.id_empleado 
        LEFT JOIN personas ON empleados.id_persona = personas.id_persona WHERE tiempoextra.id='$id'";
		$query = $this->conexion->query($sql);
		return $query->fetch(PDO::FETCH_ASSOC);
	}

    public function eliminar_tiempoextra($id)
    {

        $sql = "DELETE FROM tiempoextra WHERE id = '$id'";
        if($this->conexion->query($sql))
        {
			$_SESSION['success'] = 'El tiempo extra se eliminó correctamente';
		}else{
			$_SESSION['error'] = 'Error al Eliminar el tiempo extra, intente más tarde.';
		}
        return $_SESSION;

    }
}

?>
