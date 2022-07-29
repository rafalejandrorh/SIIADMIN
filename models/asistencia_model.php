<?php 

require_once('../../config/conn.php');

class asistencia_model 
{

    private $db;
    private $asistencia;
	public $conexion;

    public function __construct()
    {
        $this->db = Conexion::DB_mySQL();
		$this->conexion = new Conexion;
        $this->asistencia = array();
    }

	public function asistentes_atiempo_hoy()
    {
		include "../../admin/includes/timezone.php";
		$today = date('Y-m-d');

		$sql = "SELECT * FROM asistencia WHERE date = '$today' AND status = 1";
		return $this->conexion->query($sql);

    }

	public function asistentes_tarde_hoy()
    {
		include "../../admin/includes/timezone.php";
		$today = date('Y-m-d');
		$sql = "SELECT * FROM asistencia WHERE date = '$today' AND status = 0";
		return $this->conexion->query($sql);

    }

	public function asistentes_atiempo()
    {
		
        $sql = "SELECT * FROM asistencia";
        return $this->conexion->query($sql);

    }

	public function asistentes_tarde()
    {

		$sql = "SELECT * FROM asistencia WHERE status = 1";
		return $this->conexion->query($sql);

    }


    public function obtener_asistencia($from, $to)
    {
		
        $sql = "SELECT *, empleados.employee_id AS empid, asistencia.id AS attid FROM asistencia LEFT JOIN empleados ON empleados.id=asistencia.employee_id LEFT JOIN cargos ON cargos.position_id=empleados.position_id WHERE asistencia.date BETWEEN '$from' AND '$to' ORDER BY asistencia.date DESC, asistencia.time_in DESC";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

	public function insertar_asistencia_empleado($employee, $status, $date_now)
    {

		$sql = "SELECT * FROM empleados WHERE employee_id = '$employee'";
		//$query = $this->db->query($sql);
		$query = $this->conexion->query($sql);
		
		if($query->rowCount() > 0)
		{
			//$row = $query->fetch_assoc();
			$row = $query->fetch();
			$id = $row['id'];

			if($status == 'in')
			{
				$sql = "SELECT * FROM asistencia WHERE employee_id = '$id' AND date = '$date_now' AND time_in IS NOT NULL";
				$query = $this->conexion->query($sql);
				if($query->rowCount() > 0)
				{
					$_SESSION['success'] = 'Ya registraste tu entrada hoy';
				}
				else{
					
					$sched = $row['schedule_id'];
					$lognow = date('H:i:s');
					$sql = "SELECT * FROM horarios WHERE schedule_id = '$sched'";
					$squery = $this->conexion->query($sql);
					$srow = $squery->fetch(PDO::FETCH_ASSOC);
					$logstatus = ($lognow > $srow['time_in']) ? 0 : 1;
					
					$sql = "INSERT INTO asistencia (employee_id, date, time_in, status) VALUES ('$id', '$date_now', NOW(), '$logstatus')";
					if($this->conexion->query($sql))
					{
						$_SESSION['success'] = 'Llegada: '.$row['firstname'].' '.$row['lastname'];
					}
					else{
						$_SESSION['error'] = 'error 1';
					}
				}
			}
			else{
				$sql = "SELECT *, asistencia.id AS aid FROM asistencia LEFT JOIN empleados ON empleados.id=asistencia.employee_id WHERE asistencia.employee_id = '$id' AND date = '$date_now'";
				$query = $this->conexion->query($sql);
				if($query->rowCount() < 1)
				{
					$_SESSION['error'] = 'No se puede registrar tu salida, sin previamente registrar tu entrada.';
				}
				else{
					$row = $query->fetch();
					if($row['time_out'] != '00:00:00')
					{
						$_SESSION['success'] = 'Has registrado tu salida satisfactoriamente por el día de hoy';
					}
					else{
						
						$sql = "UPDATE asistencia SET time_out = NOW() WHERE id = '".$row['aid']."'";
						if($this->conexion->query($sql))
						{
							$_SESSION['success'] = 'Salida: '.$row['firstname'].' '.$row['lastname'];

							$sql = "SELECT * FROM asistencia WHERE id = '".$row['aid']."'";
							$query = $this->conexion->query($sql);
							$urow = $query->fetch();

							$time_in = $urow['time_in'];
							$time_out = $urow['time_out'];

							$sql = "SELECT * FROM empleados LEFT JOIN horarios ON horarios.schedule_id=empleados.schedule_id WHERE empleados.id = '$id'";
							$query = $this->conexion->query($sql);
							$srow = $query->fetch();

							if($srow['time_in'] > $urow['time_in'])
							{
								$time_in = $srow['time_in'];
							}

							if($srow['time_out'] < $urow['time_in'])
							{
								$time_out = $srow['time_out'];
							}

							$time_in = new DateTime($time_in);
							$time_out = new DateTime($time_out);
							$interval = $time_in->diff($time_out);
							$hrs = $interval->format('%h');
							$mins = $interval->format('%i');
							$mins = $mins/60;
							$int = $hrs + $mins;
							if($int > 4)
							{
								$int = $int - 1;
							}

							$sql = "UPDATE asistencia SET num_hr = '$int' WHERE id = '".$row['aid']."'";
							$this->conexion->query($sql);
						}
						else{

							$_SESSION['error'] = 'error 2';

						}
					}
				}
			}

		}else{
			$_SESSION['error'] = 'ID de empleado no encontrado';
		}
		return $_SESSION;

	}

    public function insertar_asistencia($employee, $date, $time_in, $time_out)
    {

        $sql = "SELECT * FROM empleados WHERE employee_id = '$employee'";
		$query = $this->conexion->query($sql);

		if($query->rowCount() < 1)
		{
			$_SESSION['error'] = 'Empleado no encontrado';
		}
		else{
			$row = $query->fetch();
			$emp = $row['id'];

			$sql = "SELECT * FROM asistencia WHERE employee_id = '$emp' AND date = '$date'";
			$query = $this->conexion->query($sql);

			if($query->rowCount() > 0)
			{
				$_SESSION['error'] = 'Ya existe registro de este empleado en el día indicado.';
			}
			else{
			
				$sched = $row['schedule_id'];
				$sql = "SELECT * FROM horarios WHERE schedule_id = '$sched'";
				$squery = $this->conexion->query($sql);
				$scherow = $squery->fetch();
				$logstatus = ($time_in > $scherow['time_in']) ? 0 : 1;
			
				$sql = "INSERT INTO asistencia (employee_id, date, time_in, time_out, status) VALUES ('$emp', '$date', '$time_in', '$time_out', '$logstatus')";
				if($this->db->query($sql))
				{
					$_SESSION['success'] = 'Asistencia añadida satisfactoriamente';
					$id = $this->conexion->lastInsertId();

					$sql = "SELECT * FROM empleados LEFT JOIN horarios ON horarios.schedule_id=empleados.schedule_id WHERE empleados.id = '$emp'";
					$query = $this->conexion->query($sql);
					$srow = $query->fetch();

					$time_in = new DateTime($time_in);
					$time_out = new DateTime($time_out);
					$interval = $time_in->diff($time_out);
					$hrs = $interval->format('%h');
					$mins = $interval->format('%i');
					$mins = $mins/60;
					$int = $hrs + $mins;
					if($int > 4)
					{
						$int = $int - 1;
					}

					$sql = "UPDATE asistencia SET num_hr = '$int' WHERE id = '$id'";
					$this->conexion->query($sql);

				}
				else{
					$_SESSION['error'] = $this->conexion->error;
				}
			}
		}
        return $_SESSION;

    }

    public function editar_asistencia($date, $time_in, $time_out, $id)
    {

        $sql = "UPDATE asistencia SET date = '$date', time_in = '$time_in', time_out = '$time_out' WHERE id = '$id'";

        if($this->conexion->query($sql))
		{
			$_SESSION['success'] = 'Asistencia actualizada satisfactoriamente';

			$sql = "SELECT * FROM asistencia WHERE id = '$id'";
			$query = $this->conexion->query($sql);
			$row = $query->fetch();
			$emp = $row['employee_id'];

			$sql = "SELECT * FROM empleados LEFT JOIN horarios ON horarios.schedule_id=empleados.schedule_id WHERE empleados.id = '$emp'";
			$query = $this->conexion->query($sql);
			$srow = $query->fetch();

			$logstatus = ($time_in > $srow['time_in']) ? 0 : 1;

			if($srow['time_in'] > $time_in)
			{
				$time_in = $srow['time_in'];
			}

			if($srow['time_out'] < $time_out)
			{
				$time_out = $srow['time_out'];
			}

			$time_in = new DateTime($time_in);
			$time_out = new DateTime($time_out);
			$interval = $time_in->diff($time_out);
			$hrs = $interval->format('%h');
			$mins = $interval->format('%i');
			$mins = $mins/60;
			$int = $hrs + $mins;
			if($int > 4)
			{
				$int = $int - 1;
			}

			$sql = "UPDATE asistencia SET num_hr = '$int', status = '$logstatus' WHERE id = '$id'";
			$this->conexion->query($sql);
		}
		else{
			$_SESSION['error'] = $this->conexion->error;
		}
        return $_SESSION;

    }

    public function eliminar_asistencia($id)
    {

        $sql = "DELETE FROM asistencia WHERE id = '$id'";
        if($this->db->query($sql))
		{
			$_SESSION['success'] = 'Asistencia eliminada satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $this->conexion->error;
		}
        return $_SESSION;

    }

}

?>
