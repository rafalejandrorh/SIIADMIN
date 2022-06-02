<?php
	if(isset($_POST['employee'])){
		$output = array('error'=>false);

		include 'conn.php';
		include 'timezone.php';

		$employee = $_POST['employee'];
		$status = $_POST['status'];

		$sql = "SELECT * FROM empleados WHERE employee_id = '$employee'";
		$query = $conn->query($sql);

		if($query->num_rows > 0){
			$row = $query->fetch_assoc();
			$id = $row['id'];

			$date_now = date('Y-m-d');

			if($status == 'in'){
				$sql = "SELECT * FROM asistencia WHERE employee_id = '$id' AND date = '$date_now' AND time_in IS NOT NULL";
				$query = $conn->query($sql);
				if($query->num_rows > 0){
					$output['error'] = true;
					$output['message'] = 'Has registrado tu entrada por hoy';
				}
				else{
					
					$sched = $row['schedule_id'];
					$lognow = date('H:i:s');
					$sql = "SELECT * FROM horarios WHERE schedule_id = '$sched'";
					$squery = $conn->query($sql);
					$srow = $squery->fetch_assoc();
					$logstatus = ($lognow > $srow['time_in']) ? 0 : 1;
					
					$sql = "INSERT INTO asistencia (employee_id, date, time_in, status) VALUES ('$id', '$date_now', NOW(), '$logstatus')";
					if($conn->query($sql)){
						$output['message'] = 'Llegada: '.$row['firstname'].' '.$row['lastname'];
					}
					else{
						$output['error'] = true;
						$output['message'] = $conn->error;
					}
				}
			}
			else{
				$sql = "SELECT *, asistencia.id AS aid FROM asistencia LEFT JOIN empleados ON empleados.id=asistencia.employee_id WHERE asistencia.employee_id = '$id' AND date = '$date_now'";
				$query = $conn->query($sql);
				if($query->num_rows < 1){
					$output['error'] = true;
					$output['message'] = 'No se puede registrar tu salida, sin previamente registrar tu entrada.';
				}
				else{
					$row = $query->fetch_assoc();
					if($row['time_out'] != '00:00:00'){
						$output['error'] = true;
						$output['message'] = 'Has registrado tu salida satisfactoriamente por el día de hoy';
					}
					else{
						
						$sql = "UPDATE asistencia SET time_out = NOW() WHERE id = '".$row['aid']."'";
						if($conn->query($sql)){
							$output['message'] = 'Salida: '.$row['firstname'].' '.$row['lastname'];

							$sql = "SELECT * FROM asistencia WHERE id = '".$row['aid']."'";
							$query = $conn->query($sql);
							$urow = $query->fetch_assoc();

							$time_in = $urow['time_in'];
							$time_out = $urow['time_out'];

							$sql = "SELECT * FROM empleados LEFT JOIN horarios ON horarios.schedule_id=empleados.schedule_id WHERE empleados.id = '$id'";
							$query = $conn->query($sql);
							$srow = $query->fetch_assoc();

							if($srow['time_in'] > $urow['time_in']){
								$time_in = $srow['time_in'];
							}

							if($srow['time_out'] < $urow['time_in']){
								$time_out = $srow['time_out'];
							}

							$time_in = new DateTime($time_in);
							$time_out = new DateTime($time_out);
							$interval = $time_in->diff($time_out);
							$hrs = $interval->format('%h');
							$mins = $interval->format('%i');
							$mins = $mins/60;
							$int = $hrs + $mins;
							if($int > 4){
								$int = $int - 1;
							}

							$sql = "UPDATE asistencia SET num_hr = '$int' WHERE id = '".$row['aid']."'";
							$conn->query($sql);
						}
						else{
							$output['error'] = true;
							$output['message'] = $conn->error;
						}
					}
					
				}
			}
		}
		else{
			$output['error'] = true;
			$output['message'] = 'ID de empleado no encontrado';
		}
		
	}
	
	echo json_encode($output);

?>