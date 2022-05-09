<?php 
        include "../admin/includes/session.php";
        require_once "../models/asistencia_model.php";
        $asistencia = new asistencia_model();
                
        if(isset($_POST['employee'])){
            $output = array('error'=>false);
            $employee = $_POST['employee'];
            $status = $_POST['status'];

            include 'conn.php';
            include 'timezone.php';
    
            
                    
            $buscarempleado = $asistencia -> insertar_asistencia_empleado($employee, $status); 

            if(isset($output['error'])){

                echo $output['error'];

            }else{
          
                echo $output['message'];
            
            }
      
        }else{
			$output['error'] = true;
			$output['message'] = 'ID de empleado no encontrado';
		}
            
        echo json_encode($output);  

?>