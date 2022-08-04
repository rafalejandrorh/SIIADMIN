<?php 

require_once('../../config/conn.php');

class sesion_model 
{

    private $db;
    public $conexion;

    public function __construct()
    {
        $this->db = Conexion::DB_mySQL();
		$this->conexion = new Conexion;
    }


    public function autenticarUsuario()
    {
        $result = $this->conexion_bd->prepare('SELECT * FROM "RENOAS".usuario WHERE  usuario = :m_usuario AND activo = 1');
        $result->bindValue(":m_usuario", $this->usuario);
        $result->execute();
        $num = $result->rowCount();
        $regitro = $result->fetch(PDO::FETCH_ASSOC);
        $this->idusuario = @$regitro['idusuario'];
        $this->idfuncionario  = @$regitro["idfuncionario "];
        $this->idnom_perfil = @$regitro["idnom_perfil"];
        $this->habilitado = @$regitro['habilitado'];
        $this->intentos = @$regitro['intentos'];
        if ($num != 0) {
            if ($this->habilitado == 1) {
                if ($this->intentos < 3) {
                    $hashTrue = password_verify($this->clave, $regitro["clave"]);
                    if ($hashTrue == true) {
                        $_SESSION['usuario'] = $this->usuario;
                        $_SESSION['idusuario'] = $this->idusuario;
                        $_SESSION['idfuncionario '] = $this->idfuncionario;
                        return 10; // ingresa exitosamente...
                    } else {
                        $intento = $this->intentos;
                        $this->intentos++;
                        $result = $this->conexion_bd->prepare('UPDATE "RENOAS".usuario set intentos=:intentos WHERE idusuario =:idusuario ');
                        $result->execute(array(':intentos' => $this->intentos, ':idusuario' => $this->idusuario));
                        return "2$intento"; // clave errada
                    }
                } else {
                    $this->habilitado = 0;
                    $result = $this->conexion_bd->prepare('UPDATE "RENOAS".usuario set habilitado=:habilitado WHERE idusuario =:idusuario ');
                    $result->execute(array(':habilitado' => $this->habilitado, ':idusuario' => $this->idusuario));
                    return 30; //  el usuario se bloquea por numero de intentos
                }
            } else {
                //el usuario se encuentra bloqueado
                return 40;
            }
        } else {
            return 50; //usuario no existe
        }
        $conexion_db = null;
    }

    public function iniciar_sesion($usuario, $contraseña)
    {

        $sql = "SELECT * FROM public.usuarios WHERE usuario = '$usuario'";
        $query = $this->conexion->query($sql);

        if($query->rowCount() < 1)
        {
            $_SESSION['error'] = 'No se encontró una cuenta con ese Usuario';
        }else{
            $row = $query->fetch();
            if($row['habilitado'] == true)
            {
                if ($row['intentos_fallidos'] < 3) {
                    if(password_verify($contraseña, $row['contraseña']))
                    {
                        $id_persona = $row['id_persona'];
                        $sql = "SELECT personas.foto, personas.nombres, personas.apellidos, personas.fecha_ingreso FROM public.personas WHERE id_persona = $id_persona";
                        $query = $this->conexion->query($sql);
                        $srow = $query->fetch();
                        $_SESSION['foto'] = $srow['foto'];
                        $_SESSION['ingreso'] = $srow['fecha_ingreso'];
                        $_SESSION['nombres'] = $srow['nombres'];
                        $_SESSION['apellidos'] = $srow['apellidos'];
                        $_SESSION['id_usuario'] = $row['id_usuario'];
                        $_SESSION['id_persona'] = $row['id_persona'];
                        $_SESSION['usuario'] = $row['usuario'];
                        $_SESSION['contraseña'] = $row['contraseña'];
                        $_SESSION['IP'] = $_SERVER['REMOTE_ADDR'];
                        $_SESSION['login_exitoso'] = 'Inicio de Sesión Exitoso';
                    }else{
                        $_SESSION['error'] = 'Contraseña Incorrecta';
                        $intentos = $row['intentos_fallidos'];
                        $intentos++;
                        $id_usuario = $row['id_usuario'];
                        $sql = "UPDATE public.usuarios SET intentos = '$intentos' WHERE id_usuario = '$id_usuario'";
                        $query = $this->conexion->query($sql);
                    }
                } else if ($row['intentos_fallidos'] == 3)
                {
                    $_SESSION['error'] = 'Superaste los 3 Intentos, tu usuario ha sido bloqueado.';
                    $habilitado = false;
                    $id_usuario = $row['id_usuario'];
                    $sql = "UPDATE public.usuarios SET habilitado = '$habilitado'  WHERE id_usuario = '$id_usuario'";
                    $query = $this->conexion->query($sql);
                } 
            }else{
                $_SESSION['error'] = 'Usuario Bloqueado o Inactivo.';
            }      
        }

    }

    public function historial_login($idusuario)
    {
        $sql = "INSERT INTO historial_sesion (idusuario, inicio_sesion) VALUES ($idusuario, CURRENT_TIMESTAMP,)";
        $this->conexion_bd->query($sql);
        return $this->conexion_bd->lastInsertId();
    }

    public function historial_logout($id)
    {
        $sql = "UPDATE historial_sesion set cierre_sesion = CURRENT_TIMESTAMP WHERE id = $id";
        $this->conexion_bd->query($sql);
    }
    ///////////////////////////////
    public function bloquear($id_usuario)
    {
        $habilitado = false;
        $sql = "UPDATE usuarios SET habilitado = '$habilitado', intentos_fallidos = 1 WHERE id_usuario= '$id_usuario'";
        $this->conexion_bd->query($sql);
    }

    public function desbloquearUsuario($id_usuario)
    {
        $habilitado = true;
        $sql = "UPDATE usuarios SET habilitado='$habilitado', intentos_fallidos = 0 WHERE id_usuario='$id_usuario'";
        $query = $this->conexion_bd->query($sql);
        $num = $query->rowCount();
        if ($num > 0) {
            echo "Usuario desbloqueado exitosamente";
        } else {
            echo "Error al desbloquear usuario";
        }
    }

    public function reseteoIntentos($id_usuario)
    {
        $sql = "UPDATE usuarios SET intentos_fallidos = 0 WHERE id_usuario='$id_usuario'";
        $result = $this->conexion_bd->query($sql);
        $estatus = match ($result->rowCount()) {
            0 => 'Ejecucion fallida',
            default => 'Ejecución exitosa',
        };

        return $estatus;
    }

    public function registrarUsuario()
    {
        $renoas = '"RENOAS"';
        $result = $this->conexion_bd->prepare("INSERT INTO $renoas.usuario(idfuncionario, idnom_perfil, usuario, clave, habilitado, intentos, tiemp_registro, tiemp_actualizacion)
            VALUES ( :idfuncionario, :idnom_perfil, :usuario, :clave, 1, 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");

        $result->execute(array(
            ':idfuncionario' => $this->idfuncionario, ':idnom_perfil' => $this->idnom_perfil, ':usuario' => $this->usuario, ':clave'=>password_hash($this->clave,PASSWORD_DEFAULT)
        ));
        return $result->rowCount(); //Cualquier dato superior a 0 indique registro exitoso
    }

    public function verificarUsuario()
    {
        $renoas = '"RENOAS"';
        $result = $this->conexion_bd->prepare("SELECT idusuario,usuario, activo  FROM $renoas.usuario WHERE idfuncionario = :idfuncionario");
        $result->execute(array(':idfuncionario' => $this->idfuncionario));
        $n = $result->rowCount();
        if ($n > 0) {
            return $result->fetch(PDO::FETCH_ASSOC);
        } else {
            return 0;
        }
    }


    public function verificarNombreUsuario()
    {
        $renoas = '"RENOAS"';
        $result = $this->conexion_bd->prepare("SELECT usuario  FROM $renoas.usuario WHERE usuario = :usuario AND activo = 1");
        $result->execute(array(':usuario' => $this->usuario));
        $n = $result->rowCount();
        if ($n > 0) {
            return $result->fetch(PDO::FETCH_ASSOC);
        } else {
            return 0;
        }
    }
    
}

?>
