<?php 

require_once('../../config/conn.php');

class login_model 
{

    private $db;
    public $conexion;

    public function __construct()
    {
        $this->db = Conexion::DB_mySQL();
		$this->conexion = new Conexion;
    }

    public function iniciar_login($username, $password)
    {

        $sql = "SELECT * FROM admin WHERE username = '$username'";
        $query = $this->conexion->query($sql);

        if($query->rowCount() < 1)
        {
            $_SESSION['error'] = 'No se encontró una cuenta con ese Usuario';
        }else{
            $row = $query->fetch();
            if(password_verify($password, $row['password']))
            {
                $_SESSION['admin'] = $row['id'];
                $_SESSION['login_exitoso'] = 'Inicio de Sesión Exitoso';
            }else{
                $_SESSION['error'] = 'Contraseña Incorrecta';
            }
        }
        return $_SESSION;

    }
    
}

?>
