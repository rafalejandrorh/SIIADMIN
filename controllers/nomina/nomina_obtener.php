<?php
        require_once "../../config/conn.php";
        require_once "../../models/nomina_model.php";
        $nomina = new nomina_model();

        $from = null;
        $to = null;
        
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

?>