<?php
	include '../../controllers/sesion/session.php';

	function generateRow(){
		$contents = '';
		require_once "../../controllers/sesion/sesion_obtener.php";
    foreach($obtener as $row){

			$contents .= "
			<tr>
        <td>".$row['nombres'].' '.$row['apellidos']."</td>
				<td>".$row['usuario']."</td>
        <td>".$row['inicio_sesion']."</td>
        <td>".$row['cierre_sesion']."</td>
        <td>".$row['ip']."</td>
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
      	<h2 align="center">Historial de Sesión - SIIADMIN</h2>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>
              <th width="20%" align="center"><b>Nombre Completo</b></th>
              <th width="20%" align="center"><b>Usuario</b></th>
              <th width="20%" align="center"><b>Inicio de Sesión</b></th>
              <th width="20%" align="center"><b>Cierre de Sesión</b></th>
              <th width="20%" align="center"><b>I.P</b></th>
           </tr>  
      ';  
    $content .= generateRow(); 
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('Historial de Sesión - SIIADMIN.pdf', 'I');

?>