<?php 
        require "../../config/conn.php";
        include "../../models/asistencia_model.php";
        include "../../empleado/includes/timezone.php";
        include "../../empleado/includes/session.php";
        $asistencia = new asistencia_model();

        if(isset($_POST['signin'])){
            $employee = $_POST['employee'];
            $status = $_POST['status'];
			$date_now = date('Y-m-d');

            
            $buscarempleado = $asistencia->insertar_asistencia_empleado($employee, $status, $date_now); 

            if(isset($_SESSION['error'])){

                echo $_SESSION['error'];

            }else{
          
                echo $_SESSION['success'];
            
            }
            
        }else{

            $_SESSION['error'] = 'Error, intente de nuevo';
            
        }
            
            header('location: ../../empleado/asistencia/index.php');  

?>