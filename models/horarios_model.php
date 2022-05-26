<?php 

class horarios_model 
{

    private $db;
    private $horarios;

    public function __construct()
    {
        
        $this->db = Conectar::conexion();
        $this->horarios = array();

    }

    public function obtener_horarios()
    {

        $sql = "SELECT * FROM horarios ORDER BY schedule_id ASC";
        $query = $this->db->query($sql);
        while($row = $query->fetch_assoc())
        {

            $this->horarios[] = $row;

        }

        return $this->horarios;

    }

    public function insertar_horarios($time_in, $time_out)
    {

        $sql = "INSERT INTO horarios (time_in, time_out) VALUES ('$time_in', '$time_out')";
        $query = $this->db->query($sql);

        if($query >=1){
            $_SESSION['success'] = 'Horarios añadidos satisfactoriamente';
    }
    else{
            $_SESSION['error'] = $this->db->error;
    }

        return $this->$_SESSION;

    }

    public function editar_horarios($time_in, $time_out, $id)
    {

        $sql = "UPDATE horarios SET time_in = '$time_in', time_out = '$time_out' WHERE schedule_id = '$id'";
        $query = $this->db->query($sql);

        if($query >= 1){
            $_SESSION['success'] = 'Horarios actualizados satisfactoriamente';
    }
    else{
        $_SESSION['error'] = $this->db->error;
    }

        return $this->$_SESSION;

    }

    public function eliminar_horarios($id)
    {

        $sql = "DELETE FROM horarios WHERE schedule_id = '$id'";
        $query = $this->db->query($sql);

        if($query >=1){
            $_SESSION['success'] = 'Horario eliminado exitosamente';
    }
    else{
            $_SESSION['error'] = $this->db->error;
        }

        return $this->$_SESSION;

    }
}

?>
