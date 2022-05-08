<?php 

require_once "../config/conn.php";

class tiempoextra_model 
{

    private $db;
    private $tiempoextra;

    public function __construct()
    {
        
        $this->db = Conectar::conexion();
        $this->tiempoextra = array();

    }

    public function obtener_tiempoextra()
    {

        //preguntar a Ing. cual sería la alternativa en este caso

        $sql = "SELECT *, tiempoextra.id AS otid FROM tiempoextra LEFT JOIN empleados ON empleados.id=tiempoextra.employee_id";
        $query = $this->db->query($sql);
        while($row = $query->fetch_assoc())
            
        {
            
            $this->tiempoextra[] = $row;
            

        }
                    
        return $this->tiempoextra;

    }

    public function insertar_tiempoextra($employee, $date, $hours, $rate)
    {

        $sql = "SELECT * FROM empleados WHERE employee_id = '$employee'";
        $query = $this->db->query($sql);

        if($query->num_rows < 1){
			$_SESSION['error'] = 'Empleado no encontrado';
		}
		else{

        $row = $query->fetch_assoc();
	    $employee_id = $row['id'];

        $sql2 = "INSERT INTO tiempoextra (employee_id, date_overtime, hours, rate) VALUES ('$employee_id', '$date', '$hours', '$rate')";

        if($this->db->query($sql2)){
            $_SESSION['success'] = 'Tiempo extra añadido satisfactoriamente';
        }
        else{
            $_SESSION['error'] = $this->db->error;
        }
    }

        return $this->$_SESSION;

    }

    public function editar_tiempoextra($date, $hours, $rate, $id)
    {

        $sql = "UPDATE tiempoextra SET hours = '$hours', rate = '$rate', date_overtime = '$date' WHERE id = '$id'";

        if($this->db->query($sql)){
			$_SESSION['success'] = 'Tiempo extra actualizado satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $this->dberror;
		}

        return $this->$_SESSION;

    }
    
    public function eliminar_tiempoextra($id)
    {

        $sql = "DELETE FROM tiempoextra WHERE id = '$id'";

        if($this->db->query($sql)){
			$_SESSION['success'] = 'El tiempo extra se eliminó correctamente';
		}
		else{
			$_SESSION['error'] = $this->db->error;
		}

        return $this->$_SESSION;

    }
}

?>
