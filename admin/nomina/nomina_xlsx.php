<?php
	header('content-type:application/xls');
	header('content-Disposition: attachment; filename=Nomina.xls');

	include '../../controllers/sesion/session.php';
?>
		
		<table>
		<thead>
					<th>Cédula de Identidad</th>
                    <th>Nombre Completo</th>
                    <th>Sueldo</th>
					<th>Deducciones</th>
					<th>Avance de Efectivo</th>
					<th>Tasa Dolar BCV</th>
                    <th>Pago Neto en $</th>
					<th>Pago Neto en Bs</th>
        </thead>
		<tbody>	
		<?php
            require_once '../../controllers/nomina/nomina_obtener.php';
            foreach($consulta_horas_trabajadas as $row)
            {
                $sueldo = $row['sueldo'] * $row['total_horas'];
                    $id_empleado = $row['empid'];   
    
                    //Obtiene el efectivo prestado al empleado
                    $consulta_avancefectivo = $nomina->consulta_avancefectivo($from, $to, $id_empleado);
                    if(!isset($consulta_avancefectivo[0]['efectivo']))
                    {
                      $consulta_avancefectivo[0]['efectivo'] = 0;
                    }  
                    //Realiza el Cálculo de la Nomina. Retorna: El total de las deducciones y el Total del Pago Neto en Bs y Dólares
                    $calculo_nomina = $nomina->calculo_nomina($sueldo, $deduction, $deduction2, $consulta_avancefectivo[0]['efectivo'], $dolar);

				echo "
                        <tr>
							<td>".$row['ci']."</td>
                            <td>".$row['apellidos'].' '.$row['nombres']."</td>
                            <td>".number_format($sueldo, 2)."</td>
							<td>".number_format($calculo_nomina['deductionley'], 2)."</td>
							<td>".number_format($consulta_avancefectivo[0]['efectivo'], 2)."</td>
							<td>".number_format(1,2)." = Bs ".number_format($dolar,2)."</td>
                            <td>".number_format($calculo_nomina['neto'], 2)."</td>
                            <td>".number_format($calculo_nomina['bs'], 2)."</td>
                        </tr>";
			};
        ?>
		</tbody>
		</table>