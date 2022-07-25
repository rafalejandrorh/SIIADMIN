<?php 

require_once('../../config/conn.php');

class perfil_model 
{

    private $db;
    private $perfil;
    public $conexion;

    public function __construct()
    {
        $this->db = Conexion::DB_mySQL();
		$this->conexion = new Conexion;
        $this->perfil = array();
    }

    public function editar_perfil($username, $password, $firstname, $lastname, $filename, $user_session)
    {

        $sql = "UPDATE admin SET username = '$username', password = '$password', firstname = '$firstname', lastname = '$lastname', photo = '$filename' WHERE id = $user_session";
        if($this->db->query($sql)){
			$_SESSION['success'] = 'Perfil de administrador actualizado correctamente';
		}
		else{
			$_SESSION['error'] = $this->dberror;
		}
        return $_SESSION;

    }
    
}

?>
