<?php
	include '../../controllers/sesion/session.php';

	function generateRow(){
		$contents = '';
		require_once "../../controllers/tiempoextra/tiempoextra_obtener.php";
    foreach($obtener as $row)
    {
      $gross = $row['monto'] * $row['horas'];
      
			$contents .= "
			<tr>
        <td>".date('d M, Y', strtotime($row['fecha']))."</td>
        <td>".$row['cedula']."</td>
        <td>".$row['nombres'].' '.$row['apellidos']."</td>
        <td>".$row['horas']."</td>
        <td>".'$ '.$row['monto']."</td>
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
              <th width="16%"><b>Fecha</b></th>
              <th width="16%"><b>Cédula de Identidad</b></th>
              <th width="16%"><b>Nombre</b></th>
              <th width="16%"><b>No. de Horas</b></th>
              <th width="16%"><b>Monto de Hora</b></th>
              <th width="16%"><b>Pago Total de Horas extra</b></th>
           </tr>  
      ';  
    $content .= generateRow(); 
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('Tiempo Extra de Empleados.pdf', 'I');

?>