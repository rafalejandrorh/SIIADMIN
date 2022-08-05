<?php 

require_once('../../config/conn.php');

class horarios_model 
{
    public $conexion;

    public function __construct()
    {
        
		$this->conexion = new Conexion;
        $this->horarios = array();

    }

    public function obtener_horarios()
    {

        $sql = "SELECT * FROM horarios ORDER BY id_horarios ASC";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function insertar_horarios($hora_llegada, $hora_salida)
    {

        $sql = "INSERT INTO horarios (hora_llegada, hora_salida) VALUES ('$hora_llegada', '$hora_salida')";
        $query = $this->conexion->query($sql);
        if($query->rowCount() >= 1){
            $_SESSION['success'] = 'Horarios añadidos satisfactoriamente';
        }else{
            $_SESSION['error'] = 'Error al insertar el horario, intente más tarde.';
        }
        return $_SESSION;

    }

    public function editar_horarios($hora_llegada, $hora_salida, $id_horarios)
    {

        $sql = "UPDATE horarios SET hora_llegada = '$hora_llegada', hora_salida = '$hora_salida' WHERE id_horarios = '$id_horarios'";
        $query = $this->conexion->query($sql);
        if($query->rowCount() >= 1){
            $_SESSION['success'] = 'Horarios actualizados satisfactoriamente';
        }else{
            $_SESSION['error'] = 'Error al editar el horario, intente más tarde.';
        }
        return $_SESSION;

    }

    public function datos_horarios($id)
    {
        $sql = "SELECT * FROM horarios WHERE id_horarios = '$id'";
        $query = $this->conexion->query($sql);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function eliminar_horarios($id_horarios)
    {

        $sql = "DELETE FROM horarios WHERE id_horarios = '$id_horarios'";
        $query = $this->conexion->query($sql);
        if($query->rowCount() >= 1){

            $sql = "UPDATE FROM empleados SET id_horarios = 13 WHERE id_horarios = $id_horarios";
            $_SESSION['success'] = 'Horario eliminado exitosamente. Recuerda reasignar Horario a los Empleados correspondientes.';

        }else{
            $_SESSION['error'] = 'Error al eliminar el horario, intente más tarde.';
        }
        return $_SESSION;
    }
}

?>
