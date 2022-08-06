<?php
	header('content-type:application/xls');
	header('content-Disposition: attachment; filename=Lista de Empleados.xls');

    include '../../controllers/sesion/session.php';
    require_once "../../controllers/empleados/empleados_obtener.php";
?>
		
		<table>
		<thead>
            <th>Cédula de Identidad</th>
            <th>Nombre Completo</th>
            <th>Cargo</th>
            <th>Sueldo por Hora</th>
            <th>Horario</th>
            <th>Residencia</th>
            <th>Teléfono</th>
        </thead>
		<tbody>	
		<?php
        
        foreach($obtener as $row)
        {
			echo "
            <tr>
                <td>".$row['cedula']."</td>
                <td>".$row['nombres']." ".$row['apellidos']."</td>
				<td>".$row['cargo']."</td>
				<td>".'$'.number_format($row['sueldo'], 2)."</td>
				<td>".date('h:i A', strtotime($row['hora_llegada'])).' - '.date('h:i A', strtotime($row['hora_salida']))."</td>
                <td>".$row['direccion']."</td>
                <td>".$row['numero_contacto']."</td>
            </tr>";
		};
        ?>
		</tbody>
		</table>