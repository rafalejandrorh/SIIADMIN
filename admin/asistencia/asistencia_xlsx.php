<?php
	header('content-type:application/xls');
	header('content-Disposition: attachment; filename=Asistencia.xls');

    include '../../controllers/sesion/session.php';
    require_once "../../controllers/asistencia/asistencia_obtener.php";
?>
		
		<table>
		<thead>
            <th class="">Fecha</th>
            <th class="">Cédula de Identidad</th>
            <th class="">Nombre Completo</th>
            <th class="">Cargo</th>
            <th class="">Hora de Entrada</th>
            <th class="">Hora de Salida</th>
            <th class="">Horas Laboradas</th>
        </thead>
		<tbody>	
		<?php
        
        foreach($obtener as $row)
        {
            $status = ($row['estatus_llegada'])?'<span class="label label-warning pull-right">A tiempo</span>':'<span class="label label-danger pull-right">Tarde</span>';
			echo "
            <tr>
				<td>".date('d-m-Y', strtotime($row['fecha']))."</td>
                <td>".$row['cedula']."</td>
                <td>".$row['nombres']." ".$row['apellidos']."</td>
				<td>".$row['cargo']."</td>
				<td>".date('h:i A', strtotime($row['hora_llegada'])).$status."</td>
				<td>".date('h:i A', strtotime($row['hora_salida']))."</td>
                <td>".number_format($row['horas_laboradas'],1)."</td>
            </tr>";
		};
        ?>
		</tbody>
		</table>