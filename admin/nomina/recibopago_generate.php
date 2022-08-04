<?php
	include '../../controllers/sesion/session.php';
	require_once "../../config/conn.php";
  require_once "../../controllers/nomina/nomina_obtener.php";

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

      foreach($consulta_horas_trabajadas as $row){
        $gross = $row['sueldo'] * $row['total_horas'];
        $id_empleado = $row['empid'];   

        //Obtiene el efectivo prestado al empleado
        $consulta_avancefectivo = $nomina->consulta_avancefectivo($from, $to, $id_empleado);
        if(!isset($consulta_avancefectivo[0]['efectivo']))
        {
            $consulta_avancefectivo[0]['efectivo'] = 0;
        } 
        //Realiza el Cálculo de la Nomina. Retorna: El total de las deducciones y el Total del Pago Neto en Bs y Dólares
        $calculo_nomina = $nomina->calculo_nomina($gross, $deduction, $deduction2, $consulta_avancefectivo[0]['efectivo'], $dolar);

        $contents .= '
          <h2 align="center">Recibo de Pago</h2>
          <h4 align="center">'.$from_title." - ".$to_title.'</h4>
          <table cellspacing="0" cellpadding="3">
                  <tr>  
                    <td width="25%" align="right">Nombre Empleado: </td>
                      <td width="25%"><b>'.$row['nombres']." ".$row['apellidos'].'</b></td>
              <td width="25%" align="right"><b>Sueldo: </b></td>
              <td width="25%" align="right"><b>'.'$ '.number_format(($row['sueldo']*$row['total_horas']), 2).'</b></td> 
                </tr>
                <tr>
                  <td width="25%" align="right">Cédula de Identidad: </td>
              <td width="25%"><b>'.$row['ci'].'</b></td>  
              <td width="25%" align="right">Deducciones de Ley: </td>
              <td width="25%" align="right">'.'$ '.number_format($calculo_nomina['deductionley'], 2).'</td>  
                </tr>
                <tr> 
              <td width="25%" align="right">Tasa Dólar BCV: </td>
              <td width="25%"><b>'.'$ '.number_format($dolar, 2).'</b></td> 
              <td width="25%" align="right">Avance de Efectivo: </td>
              <td width="25%" align="right">'.'$ '.number_format($consulta_avancefectivo[0]['efectivo'], 2).'</td> 
                </tr>

                <tr> 
              <td></td> 
              <td></td>
              <td width="25%" align="right"><b>Total Deduciones:</b></td>
              <td width="25%" align="right"><b>'.'$ '.number_format($calculo_nomina['total_deduction'], 2).'</b></td> 
                </tr>
                <tr> 
                  <td></td> 
                  <td></td>
              <td width="25%" align="right"><b>Salario Neto en Dólares:</b></td>
              <td width="25%" align="right"><b>'.'$ '.number_format($calculo_nomina['neto'], 2).'</b></td> 
                </tr>
            <tr> 
                  <td></td> 
                  <td></td>
              <td width="25%" align="right"><b>Salario Neto en Bolivares:</b></td>
              <td width="25%" align="right"><b>'.'Bs '.number_format($calculo_nomina['bs'], 2).'</b></td> 
                </tr>
            <br>
            <tr> 
              <td width="25%" align=><b>Firma Gerente RRHH: </b></td>
              <td width="25%" align=><b>_______________</b></td> 
              <td width="25%" align=><b>Firma Empleado: </b></td>
              <td width="25%" align=><b>_______________</b></td> 
                </tr>
              </table>
              <br><br><hr>';
      }
      
    $pdf->writeHTML($contents);  
    $pdf->Output('recibosueldo.pdf', 'I');

?>