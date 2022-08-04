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

    public function iniciar_login($usuario, $contraseña)
    {

        $sql = "SELECT * FROM public.usuarios WHERE usuario = '$usuario'";
        $query = $this->conexion->query($sql);

        if($query->rowCount() < 1)
        {
            $_SESSION['error'] = 'No se encontró una cuenta con ese Usuario';
        }else{
            $row = $query->fetch();
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
            }
        }

    }
    
}

?>
