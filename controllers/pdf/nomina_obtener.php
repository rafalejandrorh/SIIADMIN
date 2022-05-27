<?php 
        require_once "../../config/conn.php";
        require_once "../../models/nomina_model.php";
        $nomina = new nomina_model();

        $to = date('Y-m-d');
        $from = date('Y-m-d', strtotime('-30 day', strtotime($to)));

        if(isset($_GET['range'])){
        $range = $_GET['range'];
        $ex = explode(' - ', $range);
        $from = date('Y-m-d', strtotime($ex[0]));
        $to = date('Y-m-d', strtotime($ex[1]));
        }


        
        $horas_trabajadas = $nomina->obtener_nomina($from, $to);
        foreach($horas_trabajadas as $row){

                $gross = $row['rate'] * $row['total_hr'];
                $empid = $row['id'];
                
        
        };



        $avancefectivo = $nomina->avancefectivo($from, $to, $empid);
        foreach($avancefectivo as $deducrow){

                $deductionefectivo = $deducrow['cashamount'];
                
        };




        $deducciones = $nomina->deducciones();
        foreach($deducciones as $drow){

                $deduction = $drow['total_amount'];
        };
        //Cálculo de FAOV e IVSS
        $mensualgross = ($gross * 12)/52;
        $percentdeduction = $deduction * $mensualgross;
        $faovsso = $percentdeduction * 5;



        $deducciones2 = $nomina->deducciones2();
        foreach($deducciones2 as $drow2){

                $deduction2 = $drow2['total_amount2'];
        };
        //Cálculo de Paro Forzoso
        $paroforzoso = $gross * $deduction2;



        //Suma de deducciones por ley
        $deductionley = $faovsso + $paroforzoso;

        //Suma de Deducciones por ley y Avance de Efectivo para descontar
        $total_deduction = $deductionley + $deductionefectivo;

        //Cálculo de Sueldo a cobrar, restando el total de deducciones al sueldo neto
        $net = $gross - $total_deduction;


        
        $tasadolar = $nomina->tasadolar();
        foreach($tasadolar as $dolrow){

                $dolarbcv = $dolrow['rate_dolar'];
        };
        //Cálculo de Sueldo en Dólares
        $bs = $dolarbcv * $net;

        print_r($horas_trabajadas);

        /*$i=0;

        while($i<count($horas_trabajadas)){


                        $gross = $horas_trabajadas[$i]['rate'] * $horas_trabajadas[$i]['total_hr'];
                        $empid = $horas_trabajadas[$i]['id'];
                        
                
}*/
        // $avancefectivo = $nomina->obtener_efectivo($cedula);


?>