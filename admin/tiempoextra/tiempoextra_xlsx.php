<?php
	header('content-type:application/xls');
	header('content-Disposition: attachment; filename=Lista de Empleados.xls');

    include '../../controllers/sesion/session.php';
    require_once "../../controllers/tiempoextra/tiempoextra_obtener.php";
?>
		<table>
		<thead>
            <th>Fecha</th>
            <th>Cédula de Identidad</th>
            <th>Nombre Completo</th>
            <th>Número de Horas</th>
            <th>Monto de Hora</th>
            <th>Pago Total de Horas extra</th>
        </thead>
		<tbody>	
		<?php
        
        foreach($obtener as $row)
        {
            $gross = $row['monto'] * $row['horas'];
			echo "
            <tr>
                <td>".date('d M, Y', strtotime($row['fecha']))."</td>
                <td>".$row['cedula']."</td>
                <td>".$row['nombres']." ".$row['apellidos']."</td>
				<td>".$row['horas']."</td>
				<td>".'$'.number_format($row['monto'], 2)."</td>
                <td>".'$ '.number_format($gross, 2)."</td>
            </tr>";
		};
        ?>
		</tbody>
		</table>