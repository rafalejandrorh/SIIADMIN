<?php
	include '../../controllers/sesion/session.php';
  require_once "../../controllers/home/reportes_administracion.php";

      function generateRow($asistentes_hoy){
        $contents = '';
        
        foreach($asistentes_hoy as $row){

          if($row['horas_laboradas'] != null)
          {
              number_format($row['horas_laboradas'],1);
          }else{
              $hora_llegada = new DateTime($row['hora_llegada']);
              $hora = date('H:i:s');
              $hora_actual = new DateTime($hora);
              $interval = $hora_actual->diff($hora_llegada);
              $hrs = $interval->format('%h');
              $mins = $interval->format('%i');
              $mins = $mins/60;
              $int = $hrs + $mins;
              $row['horas_laboradas'] = $int;
          }

          $status = ($row['estatus_llegada'])?'<span class="label label-warning pull-right"> (A tiempo)</span>':'<span class="label label-danger pull-right"> (Tarde)</span>';
          $contents .= '
          <tr>
            <td align="center">'.date('d M, Y', strtotime($row['fecha'])).'</td>
            <td align="center">'.$row['cedula'].'</td>
            <td align="center">'.$row['apellidos'].', '.$row['nombres'].'</td>
            <td align="center">'.$row['cargo'].'</td>
            <td align="center">'.date('h:i A', strtotime($row['hora_llegada'])).' - '.date('h:i A', strtotime($row['hora_salida'])).'</td>
            <td align="center">'.number_format($row['horas_laboradas'],1).'</td>
          </tr>
        ';
        }

        return $contents;
      }

	  require_once('../../tcpdf_min/tcpdf.php');  
    $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Asistencia de Empleados');  
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
      	<h2 align="center">Empleados Asistentes Hoy</h2>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
                <th width="16%" align="center"><b>Fecha</b></th>
           		  <th width="16%" align="center"><b>Cédula de Identidad</b></th>
                <th width="18%" align="center"><b>Nombre Empleado</b></th>
                <th width="16%" align="center"><b>Cargo</b></th> 
                <th width="20%" align="center"><b>Hora de Asistencia</b></th>  
                <th width="14%" align="center"><b>Horas Trabajadas</b></th> 
           </tr>
      ';  
    $content .= generateRow($asistentes_hoy); 
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('Asistencia de Empleados.pdf', 'I');

?>