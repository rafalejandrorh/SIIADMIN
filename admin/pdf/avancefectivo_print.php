<?php
	include '../includes/session.php';

	function generateRow(){
		$contents = '';
		require_once "../../controllers/avancefectivo/avancefectivo_obtener.php";
    foreach($obtener as $row){

			$contents .= "
			<tr>
        <td>".date('M d, Y', strtotime($row['date_advance']))."</td>
        <td>".$row['empid']."</td> 
        <td>".$row['firstname'].' '.$row['lastname']."</td> 
        <td>".'$ '.number_format($row['amount'], 2)."</td>
			</tr>
			";
		}

		return $contents;
	}

	require_once('../../tcpdf_min/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Lista de Empleados');  
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
      	<h2 align="center">Lista de Empleados</h2>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>
            <th width="25%">Fecha</th>
            <th width="25%">Cédula de Identidad</th>
            <th width="25%">Nombre</th>
            <th width="25%">Monto</th>
           </tr>  
      ';  
    $content .= generateRow($conn); 
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('Horario de Empleados.pdf', 'I');

?>