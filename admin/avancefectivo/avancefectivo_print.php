<?php
	include '../../controllers/sesion/session.php';

	function generateRow(){
		$contents = '';
		require_once "../../controllers/avancefectivo/avancefectivo_obtener.php";
    foreach($obtener as $row){

			$contents .= '
			<tr>
        <td align="center">'.date('d M, Y', strtotime($row['fecha'])).'</td>
        <td align="center">'.$row['ci'].'</td> 
        <td align="center">'.$row['nombres'].' '.$row['apellidos'].'</td> 
        <td align="center">'.'$ '.number_format($row['monto'], 2).'</td>
			</tr>
			';
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
      	<h2 align="center">Avance de Efectivo</h2>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>
            <th width="25%" align="center"><b>Fecha</b></th>
            <th width="25%" align="center"><b>Cédula de Identidad</b></th>
            <th width="25%" align="center"><b>Nombre</b></th>
            <th width="25%" align="center"><b>Monto</b></th>
           </tr>  
      ';  
    $content .= generateRow(); 
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('Horario de Empleados.pdf', 'I');

?>