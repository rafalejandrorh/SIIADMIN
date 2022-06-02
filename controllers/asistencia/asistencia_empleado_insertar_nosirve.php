<?php 
        require_once "../../config/conn.php";
        require_once "../../models/asistencia_model.php";
        include "../../timezone.php";

        $asistencia = new asistencia_model();

        session_start();
        if(isset($_POST['signin'])){
            $employee = $_POST['employee'];
            $status = $_POST['status'];
			$date_now = date('Y-m-d');
                    
            $buscarempleado = $asistencia-> insertar_asistencia_empleado($employee, $status, $date_now); 
          
                if(isset($_SESSION['error'])){

                    echo $_SESSION['error'];

                }else{
            
                    echo $_SESSION['success'];

                }
            
            }else{

                $_SESSION['error'] = 'Error, intente de nuevo';
      
        }

        header('location: http://localhost/Sistema-MVC/index.php');

?>