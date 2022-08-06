<?php 

require_once('../../config/conn.php');

class tasadolar_model 
{
    public $conexion;

    public function __construct()
    {
		$this->conexion = new Conexion;
    }

    public function obtener_tasadolar()
    {

        $sql = "SELECT * FROM tasa_dolar";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function editar_tasadolar($tasa_dolar, $id)
    {

        $sql = "UPDATE tasa_dolar SET tasa_dolar = '$tasa_dolar' WHERE id = '$id'";
        $query = $this->conexion->query($sql);
		$_SESSION['success'] = 'Tasa del dólar modificada satisfactoriamente';

    }

    public function datos_tasadolar($id)
	{
		$sql = "SELECT * FROM tasa_dolar WHERE id = '$id'";
		$query = $this->conexion->query($sql);
		return $query->fetch(PDO::FETCH_ASSOC);
	}
    
}

?>
