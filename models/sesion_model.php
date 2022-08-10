<?php 

require_once('../../config/conn.php');

class sesion_model 
{

    private $db;
    public $conexion;

    public function __construct()
    {
		$this->conexion = new Conexion;
    }

    public function iniciar_sesion($usuario, $contraseña)
    {

        $sql = "SELECT * FROM public.usuarios LEFT JOIN usuarios_perfil ON usuarios.id_perfil = usuarios_perfil.id_perfil WHERE usuario = '$usuario' ";
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
                        $sql = "SELECT personas.foto, personas.nombres, personas.apellidos, personas.fecha_ingreso 
                        FROM public.personas WHERE id_persona = $id_persona";
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
                        $_SESSION['perfil'] = $row['id_perfil'];
                    }else{
                        $_SESSION['error'] = 'Contraseña Incorrecta';
                        $intentos = $row['intentos_fallidos'];
                        $intentos++;
                        $id_usuario = $row['id_usuario'];
                        $sql = "UPDATE public.usuarios SET intentos_fallidos = '$intentos' WHERE id_usuario = '$id_usuario'";
                        $query = $this->conexion->query($sql);
                    }
                } else if ($row['intentos_fallidos'] == 3)
                {
                    $_SESSION['error'] = 'Superaste los 3 Intentos, tu usuario ha sido bloqueado.';
                    $habilitado = 'false';
                    $id_usuario = $row['id_usuario'];
                    $sql = "UPDATE public.usuarios SET habilitado = '$habilitado'  WHERE id_usuario = '$id_usuario'";
                    $query = $this->conexion->query($sql);
                } 
            }else{
                $_SESSION['error'] = 'Usuario Bloqueado o Inactivo.';
            }      
        }

    }

    public function obtener_historial()
    {
        $sql = "SELECT historial_sesion.inicio_sesion, historial_sesion.cierre_sesion, historial_sesion.ip, usuarios.usuario, personas.nombres, personas.apellidos 
        FROM historial_sesion 
        LEFT JOIN usuarios ON historial_sesion.id_usuario = usuarios.id_usuario
        LEFT JOIN personas ON usuarios.id_persona = personas.id_persona";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function historial_login($id_usuario, $IP)
    {
        $sql = "INSERT INTO historial_sesion (id_usuario, inicio_sesion, ip) VALUES ($id_usuario, CURRENT_TIMESTAMP, '$IP')";
        $this->conexion->query($sql);
        return $this->conexion->lastInsertId();
    }

    public function historial_logout($id)
    {
        $sql = "UPDATE historial_sesion set cierre_sesion = CURRENT_TIMESTAMP WHERE id = $id";
        $this->conexion->query($sql);
    }
    ///////////////////////////////
    public function bloquear($id_usuario)
    {
        $habilitado = 'false';
        $sql = "UPDATE usuarios SET habilitado = '$habilitado', intentos_fallidos = 1 WHERE id_usuario= '$id_usuario'";
        $this->conexion->query($sql);
    }

    public function sesiones_abiertas()
    {
        $date = date('Y-m-d');
        $sql = "SELECT id FROM historial_sesion WHERE cierre_sesion IS NULL";
        return $this->conexion->query($sql);
    }

    public function reseteoIntentos($id_usuario)
    {
        $sql = "UPDATE usuarios SET intentos_fallidos = 0 WHERE id_usuario='$id_usuario'";
        $result = $this->conexion->query($sql);
        $estatus = match ($result->rowCount()) {
            0 => 'Ejecucion fallida',
            default => 'Ejecución exitosa',
        };

        return $estatus;
    }

    public function verificarUsuario()
    {
        $renoas = '"RENOAS"';
        $result = $this->conexion->prepare("SELECT id_usuario,usuario, activo  FROM $renoas.usuario WHERE idfuncionario = :idfuncionario");
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
        $result = $this->conexion->prepare("SELECT usuario  FROM $renoas.usuario WHERE usuario = :usuario AND activo = 1");
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
