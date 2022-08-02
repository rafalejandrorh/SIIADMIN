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

    public function editar_perfil($usuario, $contraseña, $id_usuario)
    {

        $sql = "UPDATE usuarios SET usuario = '$usuario', contraseña = '$contraseña' WHERE id_usuario = $id_usuario";
        if($this->db->query($sql)){
			$_SESSION['success'] = 'Perfil de administrador actualizado correctamente';
		}
		else{
			$_SESSION['error'] = $this->dberror;
		}

    }
    
}

?>
