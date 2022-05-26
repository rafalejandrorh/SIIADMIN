<?php 

class empleados_model 
{

    private $db;
    private $empleados;

    public function __construct()
    {
        
        $this->db = Conectar::conexion();
        $this->empleados = array();

    }

    public function obtener_total_empleados()
    {

        $sql = "SELECT * FROM empleados";
        $query = $this->db->query($sql);

        $this->empleados[] = $query;

        return $this->empleados;

    }

    public function obtener_empleados()
    {

        $sql = "SELECT * FROM empleados LEFT JOIN cargos ON cargos.position_id=empleados.position_id LEFT JOIN horarios ON horarios.schedule_id=empleados.schedule_id";
        $query = $this->db->query($sql);
        while($row = $query->fetch_assoc())
        {

            $this->empleados[] = $row;

        }   

        return $this->empleados;

    }

    public function insertar_empleados($employee_id, $firstname, $lastname, $address, $birthdate, $contact, $gender, $position, $schedule, $filename)
    {

        $sql = "INSERT INTO empleados (employee_id, firstname, lastname, address, birthdate, contact_info, gender, position_id, schedule_id, photo, created_on) VALUES ('$employee_id', '$firstname', '$lastname', '$address', '$birthdate', '$contact', '$gender', '$position', '$schedule', '$filename', NOW())";
        $query = $this->db->query($sql);

        if($query >= 1){
            $_SESSION['success'] = 'Empleado añadido satisfactoriamente';
        }
        else{
            $_SESSION['error'] = $this->db->error;
        }

        return $this->$_SESSION;

    }

    public function editar_empleados($empid, $firstname, $lastname, $address, $birthdate, $contact, $gender, $position, $schedule)
    {

        $sql = "UPDATE empleados SET firstname = '$firstname', lastname = '$lastname', address = '$address', birthdate = '$birthdate', contact_info = '$contact', gender = '$gender', position_id = '$position', schedule_id = '$schedule' WHERE employee_id = '$empid'";
        $query = $this->db->query($sql);

        if($query >= 1){
            $_SESSION['success'] = 'Empleado actualizado con éxito';
        }
        else{
            $_SESSION['error'] = $this->db->error;
        }

        return $this->$_SESSION;

    }

    public function eliminar_empleados($id)
    {

        $sql = "DELETE FROM empleados WHERE employee_id = '$id'";
        $query = $this->db->query($sql);

        if($query >= 1){
            $_SESSION['success'] = 'Empleado eliminado con éxito';
        }
        else{
            $_SESSION['error'] = $this->db->error;
        }
        return $this->$_SESSION;

    }

    public function editar_foto_empleados($empid, $filename)
    {

        $sql = "UPDATE empleados SET photo = '$filename' WHERE employee_id = '$empid'";
        $query = $this->db->query($sql);

        if($query >= 1){
            $_SESSION['success'] = 'La foto de tu empleado fue actualizada satisfactoriamente';
        }
        else{
            $_SESSION['error'] = $this->db->error;
        }

        return $this->$_SESSION;

    }
}

?>
