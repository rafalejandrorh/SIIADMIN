<?php 

require_once('../../config/conn.php');

class personas_model 
{
    public $conexion;

    public function __construct()
    {
		$this->conexion = new Conexion;
    }

    public function lista_personas()
    {
        $sql = "SELECT id_persona, nombres, apellidos FROM personas";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtener_persona($id_empleado)
    {
        $sql = "SELECT id_persona FROM empleados WHERE id_empleado = $id_empleado";
        $query = $this->conexion->query($sql);
        $dato = $query->fetch(PDO::FETCH_ASSOC);
        if ($query->rowCount() >= 1) {
            return $dato['id_persona'];
        }else{
            return $query->rowCount();
        }
    }

    public function obtener_id_persona($cedula)
    {

        $sql = "SELECT id_persona FROM personas WHERE cedula = $cedula";
        $query = $this->conexion->query($sql);
        if($query->rowCount() >= 1)
        {
            $dato = $query->fetch();
            return $dato['id_persona'];

        }else{
            $_SESSION['error'] = 'Error, La Persona indicada no está registrada en el Sistema.';
            return 0;
        }

    }

    public function insertar_persona($cedula, $nombres, $apellidos, $direccion, $fecha_nacimiento, $numero_contacto, $genero, $foto, $foto_cedula, $foto_rif)
    {

        $sql = "INSERT INTO personas (cedula, nombres, apellidos, direccion, fecha_nacimiento, numero_contacto, genero, foto, 
        fecha_ingreso, foto_cedula, foto_rif) VALUES ('$cedula', '$nombres', '$apellidos', '$direccion', '$fecha_nacimiento', '$numero_contacto', 
        '$genero', '$foto', NOW()), '$foto_cedula', '$foto_rif'";
        $query = $this->conexion->query($sql);
        if($query->rowCount() >= 1)
        {
            $id_persona = $this->conexion->lastInsertId();
            return $id_persona;
        }else{
            $_SESSION['error'] = 'Error al insertar los Datos de la persona, intente más tarde.';
        }
        return $_SESSION;
    }

    public function validar_persona($cedula)
    {

        $sql = "SELECT id_persona FROM personas WHERE cedula = '$cedula'";
        $query = $this->conexion->query($sql);
        if($query->rowCount() >= 1)
        {

            $dato = $query->fetch();
            $_SESSION['error'] = "La siguiente Cédula ya se encuentra registrada en el Sistema: $cedula";
            return $query->rowCount();

        }else{
            return 0;
        }

    }

    public function editar_persona_empleado($id_persona, $cedula, $nombres, $apellidos, $direccion, $fecha_nacimiento, $numero_contacto, $genero)
    {

        $sql = "UPDATE personas SET cedula = '$cedula', nombres = '$nombres', apellidos = '$apellidos', direccion = '$direccion', fecha_nacimiento = '$fecha_nacimiento', numero_contacto = '$numero_contacto', genero = '$genero' WHERE id_persona = '$id_persona'";
        $query = $this->conexion->query($sql);
        $_SESSION['success'] = 'Datos del Empleado actualizados con éxito';

    }

    public function editar_persona_usuario($id_persona, $nombres, $apellidos, $foto)
    {

        $sql = "UPDATE personas SET nombres = '$nombres', apellidos = '$apellidos', foto = '$foto' WHERE id_persona = '$id_persona'";
        $query = $this->conexion->query($sql);

    }
}    

?>