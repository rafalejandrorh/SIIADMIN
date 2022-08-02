<?php 

require_once('../../config/conn.php');

class empleados_model 
{

    private $db;
    private $empleados;
    public $conexion;

    public function __construct()
    {
        
        $this->db = Conexion::DB_mySQL();
		$this->conexion = new Conexion;
        $this->empleados = array();

    }

    public function obtener_total_empleados()
    {

        $sql = "SELECT * FROM empleados";
        return $this->conexion->query($sql);

    }

    public function obtener_empleados()
    {

        $sql = "SELECT personas.cedula, personas.nombres, personas.apellidos, cargos.cargo, cargos.sueldo, horarios.hora_llegada, 
        horarios.hora_salida, personas.direccion, personas.numero_contacto, personas.foto, empleados.id_empleado AS id
        FROM empleados 
        LEFT JOIN personas ON empleados.id_persona = personas.id_persona 
        LEFT JOIN cargos ON empleados.id_cargo = cargos.id_cargo 
        LEFT JOIN horarios ON horarios.id_horarios = empleados.id_horarios
        WHERE estatus = 1";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function obtener_empleado($id_persona)
    {

		$sql = "SELECT empleados.id_empleado FROM empleados WHERE empleados.id_persona = '$id_persona'";
		$query = $this->conexion->query($sql);
        if($query->rowCount() >= 1)
        {
            $dato = $query->fetch();
            return $dato['id_empleado'];
        }else{
            $_SESSION['error'] = 'Error, la Persona indicada no está registrada como Empleado.';
            return 0;
        }    

    }

    public function insertar_empleado($id_persona, $id_cargo, $id_horarios)
    {

        $sql = "INSERT INTO empleados (id_persona, id_cargo, id_horarios, estatus) VALUES ('$id_persona', '$id_cargo', '$id_horarios', 1)";
        $query = $this->conexion->query($sql);
        if($query->rowCount() >= 1){
            $_SESSION['success'] = 'Empleado añadido satisfactoriamente';
        }else{
            $_SESSION['error'] = 'Error al Ingresar el Cargo y el Horario del Empleado, intente más tarde.';
        }
        return $_SESSION;

    }

    public function editar_empleado($id_empleado, $id_cargo, $id_horario)
    {

            $sql = "UPDATE empleados SET id_cargo = $id_cargo, id_horarios = $id_horario WHERE id_empleado = $id_empleado";
            $query = $this->conexion->query($sql);
            $_SESSION['success'] = 'Datos del Empleado actualizados con éxito';

    }

    public function editar_foto_empleados($id_persona, $foto)
    {

        $sql = "UPDATE personas SET foto = '$foto' WHERE id_persona = '$id_persona'";
        $query = $this->conexion->query($sql);
        if($query->rowCount() >= 1){
            $_SESSION['success'] = 'La foto de tu empleado fue actualizada satisfactoriamente';
            return $query->rowCount();
        }else{
            $_SESSION['error'] = $this->conexion->error;
            return $query->rowCount();
        }

    }

    public function inactivar_empleado($id_empleado)
    {

        $sql = "UPDATE empleados SET estatus = 0 WHERE id_empleado = '$id_empleado'";
        $query = $this->conexion->query($sql);
        if($query->rowCount() >= 1){
            $_SESSION['success'] = 'Empleado eliminado con éxito';
            return $query->rowCount();
        }else{
            $_SESSION['error'] = $this->conexion->error;
            return $query->rowCount();
        }

    }

}

?>
