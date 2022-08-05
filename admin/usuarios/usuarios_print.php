<?php
	include '../../controllers/sesion/session.php';

	function generateRow(){
		$contents = '';
		require_once "../../controllers/usuarios/usuarios_obtener.php";
    foreach($obtener as $row){

      if($row['habilitado'] == 1)
      {
        $row['habilitado'] = '<span class="label label-success pull-right">Habilitado</span>';
      } 
      else if($row['habilitado'] == null)
      {
        $row['habilitado'] = '<span class="label label-danger pull-right">Deshabilitado</span>';
      }

			$contents .= "
			<tr>
        <td>".$row['cedula']."</td>
				<td>".$row['nombres'].", ".$row['apellidos']."</td>
        <td>".$row['usuario']."</td>
        <td>".$row['habilitado']."</td>
        <td>".$row['fecha_creacion']."</td>
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
      	<h2 align="center">Lista de Usuarios - SIIADMIN</h2>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>
              <th width="20%" align="center"><b>Cédula de Identidad</b></th>  
           		<th width="20%" align="center"><b>Nombre Empleado</b></th>
              <th width="20%" align="center"><b>Usuario</b></th>
              <th width="20%" align="center"><b>Estatus</b></th>
				      <th width="20%" align="center"><b>Fecha de Creación</b></th> 
           </tr>  
      ';  
    $content .= generateRow(); 
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('Lista de Usuarios - SIIADMIN.pdf', 'I');

?>