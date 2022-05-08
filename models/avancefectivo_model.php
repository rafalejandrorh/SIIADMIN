<?php 

require_once "../config/conn.php";

class avancefectivo_model 
{

    private $db;
    private $avancefectivo;

    public function __construct()
    {
        
        $this->db = Conectar::conexion();
        $this->avancefectivo = array();

    }

    public function obtener_avancefectivo()
    {

        //preguntar a Ing. cual sería la alternativa en este caso

        $sql = "SELECT *, avancefectivo.id AS caid, empleados.employee_id AS empid FROM avancefectivo LEFT JOIN empleados ON empleados.id=avancefectivo.employee_id";
        $query = $this->db->query($sql);
        while($row = $query->fetch_assoc())
            
        {
            
            $this->avancefectivo[] = $row;
            

        }
                    
        return $this->avancefectivo;

    }

    public function insertar_avancefectivo($employee, $amount)
    {

        $sql = "SELECT * FROM empleados WHERE employee_id = '$employee'";
		$query = $this->db->query($sql);
		if($query->num_rows < 1){
			$_SESSION['error'] = 'Empleado no encontrado';
		}
		else{
			$row = $query->fetch_assoc();
			$employee_id = $row['id'];
			$sql = "INSERT INTO avancefectivo (employee_id, date_advance, amount) VALUES ('$employee_id', NOW(), '$amount')";
			if($this->db->query($sql)){
				$_SESSION['success'] = 'Avance de Efectivo añadido satisfactoriamente';
			}
			else{
				$_SESSION['error'] = $this->db->error;
			}
    }

        return $this->$_SESSION;

    }

    public function editar_avancefectivo($amount, $id)
    {

        $sql = "UPDATE avancefectivo SET amount = '$amount' WHERE id = '$id'";

        if($this->db->query($sql)){
			$_SESSION['success'] = 'Avance de Efectivo actualizado satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $this->dberror;
		}

        return $this->$_SESSION;

    }
    
    public function eliminar_avancefectivo($id)
    {

        $sql = "DELETE FROM avancefectivo WHERE id = '$id'";

        if($this->db->query($sql)){
			$_SESSION['success'] = 'Adelanto de efectivo eliminado con éxito';
		}
		else{
			$_SESSION['error'] = $this->db->error;
		}

        return $this->$_SESSION;

    }
}

?>
