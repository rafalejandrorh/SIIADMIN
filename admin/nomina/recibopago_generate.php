<?php
	include '../includes/session.php';
	require_once "../../config/conn.php";
    require_once "../../models/nomina_model.php";

    $nomina = new nomina_model();

	$range = $_POST['date_range'];
	$ex = explode(' - ', $range);
	$from = date('Y-m-d', strtotime($ex[0]));
	$to = date('Y-m-d', strtotime($ex[1]));

	//Se obtiene el monto para calcular la deduccion a cada sueldo
	$deducciones = $nomina->consulta_deducciones();
	foreach($deducciones as $drow){

			$deduction = $drow['total_amount'];
	};


	//Se obtiene el monto para calcular la deduccion a cada sueldo
	$deducciones2 = $nomina->consulta_deducciones2();
	foreach($deducciones2 as $drow2){

			$deduction2 = $drow2['total_amount2'];
	};

	$from_title = date('M d, Y', strtotime($ex[0]));
	$to_title = date('M d, Y', strtotime($ex[1]));

	require_once('../../tcpdf_min/tcpdf.php');  
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

	//Obtiene los Empleados, sus horas trabajadas y el monto a cobrar
	//por esas horas
	$horas_trabajadas = $nomina->consulta_obtener_nomina($from, $to);
	foreach($horas_trabajadas as $row){

			$gross = $row['rate'] * $row['total_hr'];
			$empid = $row['id'];   
	

	//Obtiene el efectivo prestado al empleado
	$avancefectivo = $nomina->consulta_avancefectivo($from, $to, $empid);
	foreach($avancefectivo as $deducrow){

			$deductionefectivo = $deducrow['cashamount'];    
	};


	//Cálculo de FAOV e IVSS
	$mensualgross = ($gross * 12)/52;
	$percentdeduction = $deduction * $mensualgross;
	$faovsso = $percentdeduction * 5;

	//Cálculo de Paro Forzoso
	$paroforzoso = $gross * $deduction2;

	//Suma de deducciones por ley
	$deductionley = $faovsso + $paroforzoso;

	//Suma de Deducciones por ley y Avance de Efectivo para descontar
	$total_deduction = $deductionley + $deductionefectivo;

	//Cálculo de Sueldo a cobrar, restando el total de deducciones al sueldo neto
	$net = $gross - $total_deduction;

	//Se obtiene la tasa del dolar para calcular el sueldo en Bs.D
	$tasadolar = $nomina->consulta_tasadolar();
	foreach($tasadolar as $dolrow){

			$dolarbcv = $dolrow['rate_dolar'];
	};

	
	//Cálculo de Sueldo en Dólares
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
				 	<td width="25%" align="right">'.'$ '.number_format($deductionefectivo, 2).'</td> 
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