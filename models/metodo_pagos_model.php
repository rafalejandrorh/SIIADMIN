<?php 

require_once('../../config/conn.php');

class metodo_pagos_model 
{

    public $conexion;

    public function __construct()
    {
		$this->conexion = new Conexion;
    }

    public function obtener_total_empleados()
    {
        $sql = "SELECT id_empleado FROM empleados";
        return $this->conexion->query($sql);
    }

    public function obtener_metodo_pagos()
    {

        $sql = "SELECT personas.cedula, personas.nombres, personas.apellidos, 
        FROM empleados_cuenta_bancaria
        LEFT JOIN empleados ON empleados_cuenta_bancaria.id_empleado = empleados.id_empleado
        LEFT JOIN personas ON empleados.id_persona = personas.id_persona 
        WHERE estatus = 1";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);

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

    public function datos_empleados($id_empleado)
	{
		$sql = "SELECT personas.nombres, personas.apellidos, personas.direccion, personas.fecha_nacimiento, personas.numero_contacto,
		personas.genero, cargos.id_cargo, cargos.cargo, horarios.id_horarios, horarios.hora_llegada, horarios.hora_salida, 
		personas.foto, personas.cedula, empleados.id_empleado
		FROM empleados 
		LEFT JOIN cargos ON cargos.id_cargo=empleados.id_cargo 
		LEFT JOIN horarios ON horarios.id_horarios=empleados.id_horarios 
		LEFT JOIN personas ON empleados.id_persona=personas.id_persona 
		WHERE empleados.id_empleado = '$id_empleado'";
		$query = $this->conexion->query($sql);
		return $query->fetch(PDO::FETCH_ASSOC);
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
