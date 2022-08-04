<?php
    include '../../controllers/sesion/session.php';
    require_once "../../controllers/nomina/nomina_obtener.php";

	function generateRow($from, $to, $deduction, $deduction2, $consulta_horas_trabajadas, $dolar)
        {
                require_once "../../models/nomina_model.php";
                $nomina = new nomina_model();
                $contents = '';

                foreach($consulta_horas_trabajadas as $row){
                        $sueldo = $row['sueldo'] * $row['total_horas'];
                        $id_empleado = $row['empid'];   
        
                        //Obtiene el efectivo prestado al empleado
                        $consulta_avancefectivo = $nomina->consulta_avancefectivo($from, $to, $id_empleado);
                        if(!isset($consulta_avancefectivo[0]['efectivo']))
                    {
                      $consulta_avancefectivo[0]['efectivo'] = 0;
                    }
                        //Realiza el Cálculo de la Nomina. Retorna: El total de las deducciones y el Total del Pago Neto en Bs y Dólares
                        $calculo_nomina = $nomina->calculo_nomina($sueldo, $deduction, $deduction2, $consulta_avancefectivo[0]['efectivo'], $dolar);

                        $contents .= '
                        <tr>
                        <td align="center">'.$row['apellidos'].', '.$row['nombres'].'</td>
                        <td align="center">'.$row['ci'].'</td>
                        <td align="right">'.'$ '.number_format($sueldo, 2).'</td>
                        <td align="right">'.'$ '.number_format($calculo_nomina['deductionley'], 2).'</td>
                        <td align="right">'.'$ '.number_format($consulta_avancefectivo[0]['efectivo'], 2).'</td>
                        <td align="right">'.'$ '.number_format($calculo_nomina['neto'], 2).'</td>
                        <td align="right">'.'Bs '.number_format($calculo_nomina['bs'], 2).'</td>
                        </tr>';
                }
                $contents .= '';
                return $contents;
        }

        function generateRow2($dolar)
        {
                $contents = '';
                $contents .= '
                        <tr>
                        <td align="center">'.'$ '.number_format($dolar, 2).'</td>
                        </tr>';
                $contents .= '';
                return $contents;
        }

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
                        <th width="16,2%" align="center"><b>Nombre Completo</b></th>
                        <th width="14,2%" align="center"><b>Cédula de Identidad</b></th>
                        <th width="10,2%" align="center"><b>Sueldo</b></th>
                        <th width="15,2%" align="center"><b>Deducciones</b></th>
                        <th width="12,2%" align="center"><b>Avance Efectivo</b></th>
                        <th width="15,2%" align="center"><b>Salario Neto en Dólares</b></th>
                        <th width="15,2%" align="center"><b>Salario Neto en Bolivares</b></th>  
                        </tr> ';
        $content.= generateRow($from, $to, $deduction, $deduction2, $consulta_horas_trabajadas, $dolar);  
        $content.= '</table>';

        $content.= 
                '<table border="1" cellspacing="0" cellpadding="3">  
                        <tr>  
                        <th width="16,2%" align="center"><b>Tasa del Dólar</b></th>
                        </tr>';
        $content.= generateRow2($dolar); 
        $content.= '</table>'; 

        $pdf->writeHTML($content);  
        $pdf->Output('Nomina.pdf', 'I');

?>