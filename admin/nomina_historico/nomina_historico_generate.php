<?php
    include '../../controllers/sesion/session.php';
    require_once "../../controllers/nomina/historico_nomina_obtener.php";

	function generateRow($obtener_historico_nomina)
        {
                $contents = '';

                foreach($obtener_historico_nomina as $row)
                    {

                        $contents .= '
                        <tr>
                        <td align="center">'.date('d-m-y', strtotime($row['fecha_emision'])).'</td>
                        <td align="center">'.$row['ci'].'</td>
                        <td align="center">'.$row['apellidos']." ".$row['nombres'].'</td>
                        <td align="right">'.'$ '.number_format($row['sueldo'], 2).'</td>
                        <td align="right">'.'$ '.number_format($row['total_deducciones'], 2).'</td>
                        <td align="right">'.'$ '.number_format($row['tasa_dolar'],2).'</td>
                        <td align="right">'.'$ '.number_format($row['sueldo_neto'], 2).'</td>
                        <td align="right">'.'Bs '.number_format($row['sueldo_bolivares'], 2).'</td>
                        <td align="right">'.date('d-m-y', strtotime($row['fecha_inicio_nomina'])).'-'.date('d-m-y', strtotime($row['fecha_final_nomina'])).'</td>
                        </tr>';
                }
                $contents .= '';
                return $contents;
        }

	require_once('../../tcpdf_min/tcpdf.php');  
        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
        $pdf->SetCreator(PDF_CREATOR);  
        $pdf->SetTitle('Histórico de Nómina: '.$from_title.' - '.$to_title);  
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
                <h2 align="center">Histórico de Nómina</h2>
                <h4 align="center">'.$from_title." - ".$to_title.'</h4>
                <table border="1" cellspacing="0" cellpadding="3">  
                        <tr>
                        <th width="10%" align="center"><b>Fecha Emisión</b></th>  
                        <th width="11,1%" align="center"><b>C.I</b></th>
                        <th width="13,1%" align="center"><b>Nombre Completo</b></th>
                        <th width="11,1%" align="center"><b>Sueldo</b></th>
                        <th width="11,1%" align="center"><b>Deducciones</b></th>
                        <th width="9,1%" align="center"><b>Tasa Dolar</b></th>
                        <th width="11,1%" align="center"><b>Sueldo en Dólares</b></th>
                        <th width="11,1%" align="center"><b>Sueldo en Bolivares</b></th>
                        <th width="13%" align="center"><b>Fecha Nómina</b></th>     
                        </tr> ';
        $content.= generateRow($obtener_historico_nomina);  
        $content.= '</table>';

        $pdf->writeHTML($content);  
        $pdf->Output('Histórico de Nomina.pdf', 'I');

?>