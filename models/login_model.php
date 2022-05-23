<?php 

class login_model 
{

    private $db;

    public function __construct()
    {
        
        $this->db = Conectar::conexion();

    }

    public function iniciar_login($username, $password)
    {

        $sql = "SELECT * FROM admin WHERE username = '$username'";
        $query = $this->db->query($sql);

        if($query->num_rows < 1){

            $_SESSION['error'] = 'No se encontró una cuenta con ese Usuario';

        }
        else{
            $row = $query->fetch_assoc();

            if(password_verify($password, $row['password'])){

                $_SESSION['admin'] = $row['id'];

            }
            else{

                $_SESSION['error'] = 'Contraseña Incorrecta';

            }
        }

        return $this->$_SESSION;

    }
    
}

?>
