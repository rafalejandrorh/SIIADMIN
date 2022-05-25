<?php
	include 'includes/session.php';
	
	$range = $_POST['date_range'];
	$ex = explode(' - ', $range);
	$from = date('Y-m-d', strtotime($ex[0]));
	$to = date('Y-m-d', strtotime($ex[1]));

	$sql = "SELECT *, SUM(amount) as total_amount FROM deducciones";
                    $query = $conn->query($sql);
                    $drow = $query->fetch_assoc();
                    $deduction = $drow['total_amount'];

                    $sql2 = "SELECT *, SUM(amount) as total_amount2 FROM deducciones2";
                    $query2 = $conn->query($sql2);
                    $drow2 = $query2->fetch_assoc();
                    $deduction2 = $drow2['total_amount2'];

	$from_title = date('M d, Y', strtotime($ex[0]));
	$to_title = date('M d, Y', strtotime($ex[1]));

	require_once('../tcpdf_min/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Recibo de Sueldo: '.$from_title.' - '.$to_title);  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage(); 
    $contents = '';

	$sql = "SELECT *, SUM(num_hr) AS total_hr, asistencia.employee_id AS empid FROM asistencia LEFT JOIN empleados ON empleados.id=asistencia.employee_id LEFT JOIN cargos ON cargos.position_id=empleados.position_id WHERE asistencia.date BETWEEN '$from' AND '$to' GROUP BY asistencia.employee_id ORDER BY empleados.lastname ASC, empleados.firstname ASC";

                    $query = $conn->query($sql);
                    $total = 0;
                    while($row = $query->fetch_assoc()){
                      $empid = $row['empid'];
                      
                      $casql = "SELECT *, SUM(amount) AS cashamount FROM avancefectivo WHERE employee_id='$empid' AND date_advance BETWEEN '$from' AND '$to'";
                      
                      $rsql = "SELECT *, rate_dolar FROM tasa_dolar";
                      $rquery = $conn->query($rsql);
                      $rate_dolar = $rquery->fetch_assoc();
                      $dolarbcv = $rate_dolar['rate_dolar'];

					  //$string = file_get_contents("https://s3.amazonaws.com/dolartoday/data.json");
                      //$json = json_decode($string, true);
                      //$dolarbcv = $json["USD"]["promedio_real"];

                      $caquery = $conn->query($casql);
                      $carow = $caquery->fetch_assoc();
                      $cashadvance = $carow['cashamount'];

                      $gross = $row['rate'] * $row['total_hr'];
                      $mensualgross = ($gross * 12)/52;
                      $percentdeduction = $deduction * $mensualgross;
                      $faovsso = $percentdeduction * 5;

                      $gross2 = $row['rate'] * $row['total_hr'];
                      $paroforzoso = $gross2 * $deduction2;

                      $deductionley = $faovsso + $paroforzoso;

                      $total_deduction =  $deductionley + $cashadvance;
                      $net = $gross - $total_deduction;
                      $bs = $dolarbcv * $net; 

		$contents .= '
			<h2 align="center">Recibo de Pago</h2>
			<h4 align="center">'.$from_title." - ".$to_title.'</h4>
			<table cellspacing="0" cellpadding="3">
    	       	<tr>  
            		<td width="25%" align="right">Nombre Empleado: </td>
                 	<td width="25%"><b>'.$row['firstname']." ".$row['lastname'].'</b></td>
					<td width="25%" align="right"><b>Pago Real: </b></td>
				 	<td width="25%" align="right"><b>'.'$ '.number_format(($row['rate']*$row['total_hr']), 2).'</b></td> 
    	    	</tr>
    	    	<tr>
    	    		<td width="25%" align="right">Cédula de Identidad: </td>
				 	<td width="25%"><b>'.$row['employee_id'].'</b></td>  
					<td width="25%" align="right">Deducciones: </td>
				 	<td width="25%" align="right">'.'$ '.number_format($deductionley, 2).'</td>  
    	    	</tr>
    	    	<tr> 
					<td width="25%" align="right">Tasa Dólar BCV: </td>
					<td width="25%"><b>'.'$ '.number_format($dolarbcv, 2).'</b></td> 
				 	<td width="25%" align="right">Avance de Efectivo: </td>
				 	<td width="25%" align="right">'.'$ '.number_format($cashadvance, 2).'</td> 
    	    	</tr>

    	    	<tr> 
					<td></td> 
					<td></td>
				 	<td width="25%" align="right"><b>Total Deduciones:</b></td>
				 	<td width="25%" align="right"><b>'.'$ '.number_format($total_deduction, 2).'</b></td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Salario Neto en Dólares:</b></td>
				 	<td width="25%" align="right"><b>'.'$ '.number_format($net, 2).'</b></td> 
    	    	</tr>
				<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Salario Neto en Bolivares:</b></td>
				 	<td width="25%" align="right"><b>'.'Bs '.number_format($bs, 2).'</b></td> 
    	    	</tr>
				<tr> 
					<td width="25%" align=><b>Firma Gerente RRHH: </b></td>
					<td width="25%" align=><b>_______________</b></td> 
				 	<td width="25%" align=><b>Firma Empleado: </b></td>
				 	<td width="25%" align=><b>_______________</b></td> 
    	    	</tr>
    	    </table>
    	    <br><br><hr>
		';
	}
    $pdf->writeHTML($contents);  
    $pdf->Output('recibosueldo.pdf', 'I');

?>