<?php 

require_once "../config/conn.php";

class perfil_model 
{

    private $db;
    private $perfil;

    public function __construct()
    {
        
        $this->db = Conectar::conexion();
        $this->perfil = array();

    }

    public function obtener_perfil()
    {

        //preguntar a Ing. cual sería la alternativa en este caso

        $sql = "SELECT * FROM tasa_dolar";
        $query = $this->db->query($sql);

        //$string = file_get_contents("https://s3.amazonaws.com/dolartoday/data.json");
        //$dolarbcv = json_decode($string, true);
        //$dolarbcv[USD][promedio_real]//

        while($dolarbcv = $query->fetch_assoc())
            
        {
            
            $this->perfil[] = $dolarbcv;
            

        }
                    
        return $this->perfil;

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

        return $this->$_SESSION;

    }
    
}

?>
