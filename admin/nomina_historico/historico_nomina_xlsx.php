<?php
	header('content-type:application/xls');
	header('content-Disposition: attachment; filename=Histórico de Nomina.xls');

    include '../../controllers/sesion/session.php';
?>
		
		<table>
		<thead>
            <th>Fecha Emisión</th>
            <th>C.I</th>
            <th>Nombre Completo</th>
            <th>Sueldo</th>
            <th>Total Deducciones</th>
            <th>Tasa Dolar</th>
            <th>Pago Neto en $</th>
            <th>Pago Neto en Bs</th>
            <th>Fecha de Inicio de Nómina</th>
            <th>Fecha de Final de Nómina</th>
        </thead>
		<tbody>	
		<?php
        require_once "../../controllers/nomina/historico_nomina_obtener.php";
        foreach($obtener_historico_nomina as $row)
        {
			echo "
            <tr>
				<td>".date('d-m-Y', strtotime($row['fecha_emision']))."</td>
                <td>".$row['ci']."</td>
                <td>".$row['apellidos']." ".$row['nombres']."</td>
				<td>".'$ '.number_format($row['sueldo'], 2)."</td>
				<td>".'$ '.number_format($row['total_deducciones'], 2)."</td>
				<td>".'$ '.number_format($row['tasa_dolar'],2)."</td>
                <td>".'$ '.number_format($row['sueldo_neto'], 2)."</td>
                <td>".'Bs.D '.number_format($row['sueldo_bolivares'], 2)."</td>
                <td>".date('d-m-y', strtotime($row['fecha_inicio_nomina']))."</td>
                <td>".date('d-m-y', strtotime($row['fecha_final_nomina']))."</td>
            </tr>";
		};
        ?>
		</tbody>
		</table>