<?php 

require_once('../../config/conn.php');

class usuarios_model 
{
    public $conexion;

    public function __construct()
    {
		$this->conexion = new Conexion;
    }

    public function obtener_total_usuarios()
    {

        $sql = "SELECT id_usuario FROM usuarios";
        return $this->conexion->query($sql);

    }

    public function obtener_usuarios_habilitados()
    {

        $sql = "SELECT id_usuario FROM usuarios WHERE habilitado = 'true'";
        return $this->conexion->query($sql);

    }

    public function obtener_usuarios_deshabilitados()
    {

        $sql = "SELECT id_usuario FROM usuarios WHERE habilitado = 'false'";
        return $this->conexion->query($sql);

    }

    public function obtener_usuarios()
    {

        $sql = "SELECT personas.cedula, personas.nombres, personas.apellidos, cargos.cargo, personas.foto, 
        usuarios.id_usuario, usuarios.usuario, usuarios.fecha_creacion, usuarios.habilitado
        FROM usuarios 
        LEFT JOIN personas ON usuarios.id_persona = personas.id_persona
        LEFT JOIN empleados ON personas.id_persona = empleados.id_persona 
        LEFT JOIN cargos ON empleados.id_cargo = cargos.id_cargo";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function obtener_usuario($id_persona)
    {

		$sql = "SELECT usuarios.id_empleado FROM usuarios WHERE usuarios.id_persona = '$id_persona'";
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

    public function validar_persona_usuario($id_persona)
    {

		$sql = "SELECT id_persona FROM usuarios WHERE usuarios.id_persona = '$id_persona'";
		$query = $this->conexion->query($sql);
        return $query->rowCount();

    }

    public function validar_contraseña($id_admin, $contraseña_insertada)
    {

		$sql = "SELECT contraseña FROM usuarios WHERE usuarios.id_usuario = '$id_admin'";
		$query = $this->conexion->query($sql);
        $datos = $query->fetch();
        $contraseña_real = $datos['contraseña'];
        return password_verify($contraseña_insertada, $contraseña_real);

    }

    public function validar_usuario($usuario, $id_usuario)
    {

        if($id_usuario != null)
        {

            $sql = "SELECT usuario, id_usuario FROM usuarios WHERE usuario = '$usuario'";
            $query = $this->conexion->query($sql);
            $datos = $query->fetch();
            if($query->rowCount() >= 1 && $id_usuario == $datos['id_usuario'])
            {
                return 0;
            } 
            else if($query->rowCount() >= 1 && $id_usuario != $datos['id_usuario'])
            {
                return 1;
            } 
            else if($query->rowCount() == 0) 
            {
                return 0;
            }

        }else{

            $sql = "SELECT usuario FROM usuarios WHERE usuario = '$usuario'";
            $query = $this->conexion->query($sql);
            $datos = $query->fetch();
            if($query->rowCount() >= 1)
            {
                return 1;
            } 
            else if($query->rowCount() == 0) 
            {
                return 0;
            }

        }

    }

    public function insertar_usuario($id_persona, $usuario, $estatus_usuario, $contraseña)
    {
        $hash_contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (id_persona, usuario, habilitado, fecha_creacion, contraseña, intentos_fallidos) VALUES ('$id_persona', '$usuario', '$estatus_usuario', NOW(), '$hash_contraseña', 0)";
        $query = $this->conexion->query($sql);
        if($query->rowCount() >= 1){
            $_SESSION['success'] = 'Usuario creado satisfactoriamente';
        }else{
            $_SESSION['error'] = 'Error al crear el Usuario, intente más tarde.';
        }

    }

    public function editar_usuario($id_usuario, $usuario, $estatus_usuario, $contraseña)
    {
        $hash_contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET usuario = '$usuario', habilitado = '$estatus_usuario', contraseña = '$hash_contraseña' WHERE id_usuario = $id_usuario";
        $query = $this->conexion->query($sql);
        $_SESSION['success'] = 'Usuario actualizado con éxito';
    }

    public function datos_usuarios($id_usuario)
	{
		$sql = "SELECT personas.id_persona, personas.nombres, personas.apellidos, usuarios.id_usuario, usuarios.usuario, usuarios.habilitado, usuarios.contraseña
        FROM usuarios 
        LEFT JOIN personas ON usuarios.id_persona = personas.id_persona
        WHERE usuarios.id_usuario = $id_usuario";
		$query = $this->conexion->query($sql);
        $datos = $query->fetch();
        if($datos['habilitado'] == true)
        {
            $datos['habilitado'] = 'Habilitado';
            $datos['habilitado_val'] = 'true';
        }else{
            $datos['habilitado'] = 'Deshabilitado';
            $datos['habilitado_val'] = 'false';
        }
		return array('nombres' => $datos['nombres'], 'apellidos' => $datos['apellidos'], 'usuario' => $datos['usuario'], 'habilitado' => $datos['habilitado'],
        'contraseña' => $datos['contraseña'], 'id_usuario' => $datos['id_usuario'], 'habilitado_val' => $datos['habilitado_val']);
	}

    public function bloquear_usuario($id_usuario)
    {

        $habilitado = 'false';
        $sql = "UPDATE usuarios SET habilitado = '$habilitado', intentos_fallidos = 0 WHERE id_usuario = '$id_usuario'";
        $query = $this->conexion->query($sql);
        if($query->rowCount() >= 1){
            $_SESSION['success'] = 'Usuario bloqueado con éxito';
            return $query->rowCount();
        }else{
            $_SESSION['error'] = $this->conexion->error;
            return $query->rowCount();
        }

    }

    public function desbloquearUsuario($id_usuario)
    {
        $habilitado = 'true';
        $sql = "UPDATE usuarios SET habilitado='$habilitado', intentos_fallidos = 0 WHERE id_usuario='$id_usuario'";
        $query = $this->conexion->query($sql);
        $num = $query->rowCount();
        if ($num > 0) {
            echo "Usuario desbloqueado exitosamente";
        } else {
            echo "Error al desbloquear usuario";
        }
    }

}

?>
