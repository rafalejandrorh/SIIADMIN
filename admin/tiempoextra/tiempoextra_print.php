<?php
	include '../../controllers/sesion/session.php';

	function generateRow(){
		$contents = '';
		require_once "../../controllers/tiempoextra/tiempoextra_obtener.php";
    foreach($obtener as $row)
    {
      $gross = $row['rate'] * $row['hours'];
      
			$contents .= "
			<tr>
        <td>".date('M d, Y', strtotime($row['date_overtime']))."</td>
        <td>".$row['employee_id']."</td>
        <td>".$row['firstname'].' '.$row['lastname']."</td>
        <td>".$row['hours']."</td>
        <td>".'$ '.$row['rate']."</td>
        <td>".'$ '.number_format($gross, 2)."</td>
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
      	<h2 align="center">Tiempo Extra de Empleados</h2>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>
              <th width="16%">Fecha</th>
              <th width="16%">Cédula de Identidad</th>
              <th width="16%">Nombre</th>
              <th width="16%">No. de Horas</th>
              <th width="16%">Monto de Hora</th>
              <th width="16%">Pago Total de Horas extra</th>
           </tr>  
      ';  
    $content .= generateRow($conn); 
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('Tiempo Extra de Empleados.pdf', 'I');

?>