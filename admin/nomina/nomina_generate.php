<?php
    include '../includes/session.php';
    require_once "../../config/conn.php";
    require_once "../../models/nomina_model.php";
    $nomina = new nomina_model();

	function generateRow($from, $to, $conn, $total_deduction){

        $nomina = new nomina_model();

        if(isset($_GET['range'])){
        $range = $_GET['range'];
        $ex = explode(' - ', $range);
        $from = date('Y-m-d', strtotime($ex[0]));
        $to = date('Y-m-d', strtotime($ex[1]));
        }

        //Se obtiene el monto para calcular la deduccion a cada sueldo
        $deducciones = $nomina->deducciones();
        foreach($deducciones as $drow){

                $deduction = $drow['total_amount'];
        };


        //Se obtiene el monto para calcular la deduccion a cada sueldo
        $deducciones2 = $nomina->deducciones2();
        foreach($deducciones2 as $drow2){

                $deduction2 = $drow2['total_amount2'];
        };


		$contents = '';
        
       //Obtiene los Empleados, sus horas trabajadas y el monto a cobrar
        //por esas horas
        $horas_trabajadas = $nomina->obtener_nomina($from, $to);
        foreach($horas_trabajadas as $row){

                $gross = $row['rate'] * $row['total_hr'];
                $empid = $row['id'];   
        

        //Obtiene el efectivo prestado al empleado
        $avancefectivo = $nomina->avancefectivo($from, $to, $empid);
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
        $tasadolar = $nomina->tasadolar();
        foreach($tasadolar as $dolrow){

                $dolarbcv = $dolrow['rate_dolar'];
        };

        
        //Cálculo de Sueldo en Dólares
        $bs = $dolarbcv * $net;

			$contents .= '
			<tr>
				<td align="center">'.$row['lastname'].', '.$row['firstname'].'</td>
				<td align="center">'.$row['employee_id'].'</td>
                <td align="right">'.'$ '.number_format($dolarbcv, 2).'</td>
				<td align="right">'.'$ '.number_format($net, 2).'</td>
				<td align="right">'.'Bs '.number_format($bs, 2).'</td>
			</tr>
			';
		}

		$contents .= '

        
		';
		return $contents;
    }
		
	$range = $_POST['date_range'];
	$ex = explode(' - ', $range);
	$from = date('Y-m-d', strtotime($ex[0]));
	$to = date('Y-m-d', strtotime($ex[1]));

    //Se obtiene el monto para calcular la deduccion a cada sueldo
    $deducciones = $nomina->deducciones();
    foreach($deducciones as $drow){

            $deduction = $drow['total_amount'];
    };


    //Se obtiene el monto para calcular la deduccion a cada sueldo
    $deducciones2 = $nomina->deducciones2();
    foreach($deducciones2 as $drow2){

            $deduction2 = $drow2['total_amount2'];
    };

	//Obtiene los Empleados, sus horas trabajadas y el monto a cobrar
        //por esas horas
        $horas_trabajadas = $nomina->obtener_nomina($from, $to);
        foreach($horas_trabajadas as $row){

                $gross = $row['rate'] * $row['total_hr'];
                $empid = $row['id'];   
        

        //Obtiene el efectivo prestado al empleado
        $avancefectivo = $nomina->avancefectivo($from, $to, $empid);
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
        $tasadolar = $nomina->tasadolar();
        foreach($tasadolar as $dolrow){

                $dolarbcv = $dolrow['rate_dolar'];
        };

        
        //Cálculo de Sueldo en Dólares
        $bs = $dolarbcv * $net;
    }

        $from_title = date('M d, Y', strtotime($ex[0]));
        $to_title = date('M d, Y', strtotime($ex[1]));

	require_once('../../tcpdf_min/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Nomina: '.$from_title.' - '.$to_title);  
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
    $content = '';  
    $content .= '
      	<h2 align="center">Nómina</h2>
      	<h4 align="center">'.$from_title." - ".$to_title.'</h4>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
           		<th width="20%" align="center"><b>Nombre Empleado</b></th>
                <th width="20%" align="center"><b>Cédula de Identidad</b></th>
                <th width="20%" align="center"><b>Tasa Dólar BCV</b></th>
				<th width="20%" align="center"><b>Salario Neto en Dólares</b></th>
				<th width="20%" align="center"><b>Salario Neto en Bolivares</b></th>  
           </tr>  
      ';  
    $content .= generateRow($from, $to, $conn, $total_deduction);  
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('Nomina.pdf', 'I');

?>