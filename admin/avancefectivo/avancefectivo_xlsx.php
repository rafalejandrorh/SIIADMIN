<?php
	header('content-type:application/xls');
	header('content-Disposition: attachment; filename=Avance de Efectivo.xls');

    include '../../controllers/sesion/session.php';
    require_once "../../controllers/avancefectivo/avancefectivo_obtener.php";
?>
		
		<table>
		<thead>
            <th>Fecha del Avance</th>
            <th>Cédula de Identidad</th>
            <th>Nombre Completo</th>
            <th>Monto del Avance</th>
        </thead>
		<tbody>	
		<?php
        
        foreach($obtener as $row)
        {
			echo "
            <tr>
                <td>".date('d M, Y', strtotime($row['fecha']))."</td>
                <td>".$row['ci']."</td>
                <td>".$row['nombres']." ".$row['apellidos']."</td>
				<td>".'$'.number_format($row['monto'], 2)."</td>
            </tr>";
		};
        ?>
		</tbody>
		</table>