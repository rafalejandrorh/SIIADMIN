<?php 

require_once('../../config/conn.php');

class horarios_model 
{

    private $db;
    private $horarios;
    public $conexion;

    public function __construct()
    {
        
        $this->db = Conexion::DB_mySQL();
		$this->conexion = new Conexion;
        $this->horarios = array();

    }

    public function obtener_horarios()
    {

        $sql = "SELECT * FROM horarios ORDER BY schedule_id ASC";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function insertar_horarios($time_in, $time_out)
    {

        $sql = "INSERT INTO horarios (time_in, time_out) VALUES ('$time_in', '$time_out')";
        if($this->conexion->query($sql)){
            $_SESSION['success'] = 'Horarios añadidos satisfactoriamente';
        }
        else{
            $_SESSION['error'] = $this->conexion->error;
        }
        return $_SESSION;

    }

    public function editar_horarios($time_in, $time_out, $id)
    {

        $sql = "UPDATE horarios SET time_in = '$time_in', time_out = '$time_out' WHERE schedule_id = '$id'";
        if($this->conexion->query($sql)){
            $_SESSION['success'] = 'Horarios actualizados satisfactoriamente';
        }
        else{
        $_SESSION['error'] = $this->conexion->error;
        }
        return $_SESSION;

    }

    public function eliminar_horarios($id)
    {

        $sql = "DELETE FROM horarios WHERE schedule_id = '$id'";
        if($this->conexion->query($sql)){
            $_SESSION['success'] = 'Horario eliminado exitosamente';
        }
        else{
            $_SESSION['error'] = $this->conexion->error;
        }
        return $_SESSION;

    }
}

?>
