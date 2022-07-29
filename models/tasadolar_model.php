<?php 

require_once('../../config/conn.php');

class tasadolar_model 
{

    private $db;
    private $tasadolar;
    public $conexion;

    public function __construct()
    {
        
        $this->db = Conexion::DB_mySQL();
		$this->conexion = new Conexion;
        $this->tasadolar = array();

    }

    public function obtener_tasadolar()
    {

        $sql = "SELECT * FROM tasa_dolar";
        $query = $this->conexion->query($sql);
        //$string = file_get_contents("https://s3.amazonaws.com/dolartoday/data.json");
        //$dolarbcv = json_decode($string, true);
        //$dolarbcv[USD][promedio_real]//
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function editar_tasadolar($rate_dolar, $observaciones, $id)
    {

        $sql = "UPDATE tasa_dolar SET rate_dolar = '$rate_dolar', observaciones = '$observaciones' WHERE id = '$id'";
        if($this->conexion->query($sql)){
			$_SESSION['success'] = 'Tasa del dólar modificada satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $this->dberror;
		}
        return $_SESSION;

    }
    
}

?>
