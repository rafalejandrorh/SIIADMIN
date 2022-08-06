<?php 

require_once('../../config/conn.php');

class perfil_model 
{
    public $conexion;

    public function __construct()
    {
		$this->conexion = new Conexion;
    }

    public function editar_perfil($usuario, $contraseña, $id_usuario)
    {

        $sql = "UPDATE usuarios SET usuario = '$usuario', contraseña = '$contraseña' WHERE id_usuario = $id_usuario";
        if($this->CONEXION->query($sql)){
			$_SESSION['success'] = 'Perfil de administrador actualizado correctamente';
		}
		else{
			$_SESSION['error'] = $this->dberror;
		}

    }
    
}

?>
