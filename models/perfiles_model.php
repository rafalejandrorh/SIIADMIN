<?php 

require_once('../../config/conn.php');

class perfiles_model 
{
    public $conexion;

    public function __construct()
    {
		$this->conexion = new Conexion;
    }


    public function obtener_perfiles()
    {

        $sql = "SELECT id_perfil, perfil FROM usuarios_perfil";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function validar_id_perfil($id_perfil)
    {

		$sql = "SELECT id_perfil FROM usuarios_perfil WHERE id_perfil = '$id_perfil'";
		$query = $this->conexion->query($sql);
        return $query->rowCount();

    }

    public function validar_perfil($perfil)
    {

		$sql = "SELECT perfil FROM usuarios_perfil WHERE perfil = '$perfil'";
		$query = $this->conexion->query($sql);
        return $query->rowCount();

    }

    public function insertar_perfil($id_perfil, $perfil)
    {

        $sql = "INSERT INTO usuarios_perfil (id_perfil, perfil) VALUES ('$id_perfil', '$perfil')";
        $query = $this->conexion->query($sql);
        if($query->rowCount() >= 1){
            $_SESSION['success'] = 'Perfil creado satisfactoriamente';
        }else{
            $_SESSION['error'] = 'Error al crear el Perfil, intente más tarde.';
        }

    }

    public function editar_perfil($id_perfil_nuevo, $perfil, $id_perfil)
    {
        $sql = "UPDATE usuarios_perfil SET id_perfil = '$id_perfil_nuevo', perfil = '$perfil' WHERE id_perfil = '$id_perfil'";
        $query = $this->conexion->query($sql);
        $_SESSION['success'] = 'Perfil actualizado con éxito';
    }

    public function eliminar_perfil($id_perfil)
    {
        $sql = "DELETE FROM usuarios_perfil WHERE id_perfil = '$id_perfil'";
        $query = $this->conexion->query($sql);
        $_SESSION['success'] = 'Perfil eliminado con éxito';
    }

    public function datos_perfiles($id_perfil)
	{
		$sql = "SELECT id_perfil, perfil, id_perfil as id_perfil_antiguo FROM usuarios_perfil WHERE id_perfil = $id_perfil";
		$query = $this->conexion->query($sql);
		return $query->fetch(PDO::FETCH_ASSOC);
	}

    public function lista_perfiles()
    {
        $sql = "SELECT id_perfil, perfil FROM usuarios_perfil";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>
