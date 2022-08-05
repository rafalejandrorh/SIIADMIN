<?php 

require_once('../../config/conn.php');

class asistencia_model 
{

    private $db;
    private $asistencia;
	public $conexion;

    public function __construct()
    {
		$this->conexion = new Conexion;
        $this->asistencia = array();
    }

	public function asistentes_atiempo_hoy()
    {
		include "../../admin/includes/timezone.php";
		$today = date('Y-m-d');

		$sql = "SELECT * FROM public.asistencia WHERE fecha = '$today' AND estatus_llegada = 1";
		return $this->conexion->query($sql);

    }

	public function asistentes_tarde_hoy()
    {
		include "../../admin/includes/timezone.php";
		$today = date('Y-m-d');
		$sql = "SELECT * FROM public.asistencia WHERE fecha = '$today' AND estatus_llegada = 0";
		return $this->conexion->query($sql);

    }

	public function asistentes_atiempo()
    {
		
        $sql = "SELECT * FROM public.asistencia";
        return $this->conexion->query($sql);

    }

	public function asistentes_tarde()
    {

		$sql = "SELECT * FROM public.asistencia WHERE estatus_llegada = 1";
		return $this->conexion->query($sql);

    }


    public function obtener_asistencia($from, $to)
    {
		$filtro = null;
		if($from != null && $to != null)
		{
			$filtro = "WHERE asistencia.fecha BETWEEN '$from' AND '$to'";
		}
        $sql = "SELECT *, empleados.id_empleado, asistencia.id AS attid FROM public.asistencia LEFT JOIN empleados ON empleados.id_empleado=asistencia.id_empleado LEFT JOIN cargos ON cargos.id_cargo=empleados.id_cargo LEFT JOIN personas ON personas.id_persona = empleados.id_persona $filtro ORDER BY asistencia.fecha DESC, asistencia.hora_llegada DESC";
        $query = $this->conexion->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

	public function insertar_asistencia_empleado($cedula, $status, $fecha)
    {

		$sql = "SELECT id_empleado, id_horario, nombres, apellidos  FROM public.personas LEFT JOIN empleados ON personas.id_persona = empleados.id_personas WHERE cedula = '$cedula'";
		//$query = $this->db->query($sql);
		$query = $this->conexion->query($sql);
		
		if($query->rowCount() > 0)
		{
			//$row = $query->fetch_assoc();
			$row = $query->fetch();
			$id_empleado = $row['id_empleado'];

			if($status == 'in')
			{
				$sql = "SELECT * FROM public.asistencia WHERE id_empleado = '$id_empleado' AND date = '$fecha' AND hora_llegada IS NOT NULL";
				$query = $this->conexion->query($sql);
				if($query->rowCount() > 0)
				{
					$_SESSION['success'] = 'Ya registraste tu entrada hoy';
				}
				else{
					
					$id_horarios = $row['id_horarios'];
					$lognow = date('H:i:s');
					$sql = "SELECT * FROM horarios WHERE id_horarios = '$id_horarios'";
					$squery = $this->conexion->query($sql);
					$srow = $squery->fetch(PDO::FETCH_ASSOC);
					$logstatus = ($lognow > $srow['hora_llegada']) ? 0 : 1;
					
					$sql = "INSERT INTO public.asistencia (id_empleado, fecha, hora_llegada, estatus_llegada) VALUES ('$id_empleado', '$fecha', NOW(), '$logstatus')";
					if($this->conexion->query($sql))
					{
						$_SESSION['success'] = 'Llegada: '.$row['nombres'].' '.$row['apellidos'];
					}
					else{
						$_SESSION['error'] = 'error 1';
					}
				}
			}else{
				$sql = "SELECT *, asistencia.id AS aid FROM public.asistencia LEFT JOIN empleados ON empleados.id_empleado=asistencia.id_empleado WHERE asistencia.id_empleado = '$id_empleado' AND date = '$fecha'";
				$query = $this->conexion->query($sql);
				if($query->rowCount() < 1)
				{
					$_SESSION['error'] = 'No se puede registrar tu salida, sin previamente registrar tu entrada.';
				}else{
					$row = $query->fetch();
					if($row['hora_salida'] != '00:00:00')
					{
						$_SESSION['success'] = 'Has registrado tu salida satisfactoriamente por el día de hoy';
					}else{
						
						$sql = "UPDATE public.asistencia SET hora_salida = NOW() WHERE id = '".$row['aid']."'";
						if($this->conexion->query($sql))
						{
							$_SESSION['success'] = 'Salida: '.$row['nombres'].' '.$row['apelldos'];

							$sql = "SELECT * FROM public.asistencia WHERE id = '".$row['aid']."'";
							$query = $this->conexion->query($sql);
							$urow = $query->fetch();

							$hora_llegada = $urow['hora_llegada'];
							$hora_salida = $urow['hora_salida'];

							$sql = "SELECT * FROM public.empleados LEFT JOIN horarios ON horarios.id_horarios=empleados.id_horarios WHERE empleados.id_empleado = '$id'";
							$query = $this->conexion->query($sql);
							$srow = $query->fetch();

							if($srow['hora_llegada'] > $urow['hora_llegada'])
							{
								$hora_llegada = $srow['hora_llegada'];
							}

							if($srow['hora_salida'] < $urow['hora_llegada'])
							{
								$hora_salida = $srow['hora_salida'];
							}

							$hora_llegada = new DateTime($hora_llegada);
							$hora_salida = new DateTime($hora_salida);
							$interval = $hora_llegada->diff($hora_salida);
							$hrs = $interval->format('%h');
							$mins = $interval->format('%i');
							$mins = $mins/60;
							$int = $hrs + $mins;
							if($int > 4)
							{
								$int = $int - 1;
							}

							$sql = "UPDATE public.asistencia SET horas_laboradas = '$int' WHERE id = '".$row['aid']."'";
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

    public function insertar_asistencia($cedula, $fecha, $hora_llegada, $hora_salida)
    {

		$sql = "SELECT id_empleado, id_horarios, nombres, apellidos FROM public.personas LEFT JOIN empleados ON personas.id_persona = empleados.id_persona WHERE cedula = '$cedula'";
		$query = $this->conexion->query($sql);

		if($query->rowCount() < 1)
		{
			$_SESSION['error'] = 'Empleado no encontrado';
		}
		else{
			$row = $query->fetch();
			$id_empleado = $row['id_empleado'];

			$sql = "SELECT * FROM public.asistencia WHERE id_empleado = '$id_empleado' AND fecha = '$fecha'";
			$query = $this->conexion->query($sql);

			if($query->rowCount() > 0)
			{
				$_SESSION['error'] = 'Ya existe registro de este empleado en el día indicado.';
			}
			else{
			
				$sched = $row['id_horarios'];
				$sql = "SELECT * FROM public.horarios WHERE id_horarios = '$sched'";
				$squery = $this->conexion->query($sql);
				$scherow = $squery->fetch();
				$logstatus = ($hora_llegada > $scherow['hora_llegada']) ? 0 : 1;
			
				$sql = "INSERT INTO public.asistencia (id_empleado, fecha, hora_llegada, hora_salida, estatus_llegada) VALUES ('$id_empleado', '$fecha', '$hora_llegada', '$hora_salida', '$logstatus')";
				if($this->conexion->query($sql))
				{
					$_SESSION['success'] = 'Asistencia añadida satisfactoriamente';
					$id = $this->conexion->lastInsertId();

					$sql = "SELECT * FROM public.empleados LEFT JOIN horarios ON horarios.id_horarios=empleados.id_horarios WHERE empleados.id_empleado = '$id_empleado'";
					$query = $this->conexion->query($sql);
					$srow = $query->fetch();

					$hora_llegada = new DateTime($hora_llegada);
					$hora_salida = new DateTime($hora_salida);
					$interval = $hora_llegada->diff($hora_salida);
					$hrs = $interval->format('%h');
					$mins = $interval->format('%i');
					$mins = $mins/60;
					$int = $hrs + $mins;
					if($int > 4)
					{
						$int = $int - 1;
					}

					$sql = "UPDATE public.asistencia SET horas_laboradas = '$int' WHERE id = '$id'";
					$this->conexion->query($sql);

				}
				else{
					$_SESSION['error'] = $this->conexion->error;
				}
			}
		}
        return $_SESSION;

    }

    public function editar_asistencia($fecha, $hora_llegada, $hora_salida, $id)
    {

        $sql = "UPDATE public.asistencia SET fecha = '$fecha', hora_llegada = '$hora_llegada', hora_salida = '$hora_salida' WHERE id = '$id'";

        if($this->conexion->query($sql))
		{
			$_SESSION['success'] = 'Asistencia actualizada satisfactoriamente';

			$sql = "SELECT * FROM public.asistencia WHERE id = '$id'";
			$query = $this->conexion->query($sql);
			$row = $query->fetch();
			$id_empleado = $row['id_empleado'];

			$sql = "SELECT * FROM public.empleados LEFT JOIN horarios ON horarios.id_horarios=empleados.id_horarios WHERE empleados.id_empleado = '$id_empleado'";
			$query = $this->conexion->query($sql);
			$srow = $query->fetch();

			$logstatus = ($hora_llegada > $srow['hora_llegada']) ? 0 : 1;

			if($srow['hora_llegada'] > $hora_llegada)
			{
				$hora_llegada = $srow['hora_llegada'];
			}

			if($srow['hora_salida'] < $hora_salida)
			{
				$hora_salida = $srow['hora_salida'];
			}

			$hora_llegada = new DateTime($hora_llegada);
			$hora_salida = new DateTime($hora_salida);
			$interval = $hora_llegada->diff($hora_salida);
			$hrs = $interval->format('%h');
			$mins = $interval->format('%i');
			$mins = $mins/60;
			$int = $hrs + $mins;
			if($int > 4)
			{
				$int = $int - 1;
			}

			$sql = "UPDATE public.asistencia SET horas_laboradas = '$int', estatus_llegada = '$logstatus' WHERE id = '$id'";
			$this->conexion->query($sql);
		}
		else{
			$_SESSION['error'] = $this->conexion->error;
		}
        return $_SESSION;

    }

	public function datos_asistencia($id)
	{
		$sql = "SELECT *, asistencia.id as attid FROM asistencia LEFT JOIN empleados ON empleados.id_empleado = asistencia.id_empleado 
		LEFT JOIN personas ON empleados.id_persona = personas.id_persona WHERE asistencia.id = $id";
		$query = $this->conexion->query($sql);
		return $query->fetch(PDO::FETCH_ASSOC);
	}

    public function eliminar_asistencia($id)
    {

        $sql = "DELETE FROM public.asistencia WHERE id = '$id'";
        if($this->conexion->query($sql))
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
