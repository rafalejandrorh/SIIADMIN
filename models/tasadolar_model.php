<?php 

class tasadolar_model 
{

    private $db;
    private $tasadolar;

    public function __construct()
    {
        
        $this->db = Conectar::conexion();
        $this->tasadolar = array();

    }

    public function obtener_tasadolar()
    {

        //preguntar a Ing. cual sería la alternativa en este caso

        $sql = "SELECT * FROM tasa_dolar";
        $query = $this->db->query($sql);

        //$string = file_get_contents("https://s3.amazonaws.com/dolartoday/data.json");
        //$dolarbcv = json_decode($string, true);
        //$dolarbcv[USD][promedio_real]//

        while($dolarbcv = $query->fetch_assoc())
            
        {
            
            $this->tasadolar[] = $dolarbcv;
            

        }
                    
        return $this->tasadolar;

    }

    public function editar_tasadolar($rate_dolar, $id)
    {

        $sql = "UPDATE tasa_dolar SET rate_dolar = '$rate_dolar' WHERE id = '$id'";

        if($this->db->query($sql)){
			$_SESSION['success'] = 'Tasa del dólar modificada satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $this->dberror;
		}

        return $this->$_SESSION;

    }
    
    }

?>
