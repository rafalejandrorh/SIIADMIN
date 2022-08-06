<?php
        require_once "../../models/nomina_model.php";
        $nomina = new nomina_model();

        $from = null;
        $to = null;
        $range = null;
        
        if(isset($_GET['range']))
        {
                $range = $_GET['range'];
                $ex = explode(' - ', $range);
                $from = date('Y-m-d', strtotime($ex[0]));
                $to = date('Y-m-d', strtotime($ex[1]));
        }

        if(isset($_POST['date_range']))
        {
                $range = $_POST['date_range'];
                $ex = explode(' - ', $range);
                $from = date('Y-m-d', strtotime($ex[0]));
                $to = date('Y-m-d', strtotime($ex[1]));
                $from_title = date('M d, Y', strtotime($ex[0]));
	        $to_title = date('M d, Y', strtotime($ex[1]));
        }

        //Se obtiene el monto para calcular la deduccion a cada sueldo
        $consulta_deducciones = $nomina->consulta_deducciones();
        $deduction = $consulta_deducciones['total_monto'];

        //Se obtiene el monto para calcular la deduccion a cada sueldo
        $consulta_deducciones2 = $nomina->consulta_deducciones2();
        $deduction2 = $consulta_deducciones2['total_monto'];

        //Se obtiene la tasa del dolar para calcular el sueldo en Bs.D
        $tasadolar = $nomina->consulta_tasadolar();
        $dolar = $tasadolar['tasa_dolar'];

        //Obtiene los Empleados, sus horas trabajadas y el monto a cobrar por esas horas
        $consulta_horas_trabajadas = $nomina->consulta_obtener_nomina($from, $to);

        if(isset($_POST['guardar']))
        {
                $range = $_GET['range'];
                $ex = explode(' - ', $range);
                $from = date('Y-m-d', strtotime($ex[0]));
                $to = date('Y-m-d', strtotime($ex[1]));

                foreach($consulta_horas_trabajadas as $row)
                {
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

                        $fecha_emision = date('Y-m-d');
                        $exfrom = explode('-', $from);
                        $exto = explode('-', $to);
                        $id_nomina = $exfrom[0].$exfrom[1].$exfrom[2].'-'.$exto[0].$exto[1].$exto[2].'-'.$id_empleado;
                        $sueldo_prox = number_format($sueldo, 2);
                        $deductionley = number_format($calculo_nomina['deductionley'],2);
                        $total_deduction = number_format($calculo_nomina['total_deduction'],2);
                        $neto = number_format($calculo_nomina['neto'],2);
                        $bs = number_format($calculo_nomina['bs'],2);

                        $historico_nomina = $nomina->guardar_historico_nomina($id_nomina, $id_empleado, $sueldo_prox, $deductionley, 
                        $consulta_avancefectivo[0]['efectivo'], $total_deduction, $dolar, $neto, $bs, 
                        $fecha_emision, $from, $to);
                }
                //header("Location: ../../admin/historico_nomina/index.php");
        }        

?>