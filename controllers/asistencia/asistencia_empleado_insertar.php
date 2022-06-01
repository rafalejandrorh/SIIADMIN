<?php 
        require_once "../../config/conn.php";
        require_once "../../models/asistencia_model.php";

        $asistencia = new asistencia_model();

        session_start();
        if(isset($_POST['signin'])){
            $employee = $_POST['employee'];
            $status = $_POST['status'];
                    
            $buscarempleado = $asistencia-> insertar_asistencia_empleado($employee, $status); 
          
                if(isset($_SESSION['error'])){

                    echo $_SESSION['error'];

                }else{
            
                    echo $_SESSION['messages'];

                }
            
            }else{

                $_SESSION['error'] = 'Error, intente de nuevo';
      
        }

        header('location: http://localhost/Sistema-MVC/index.php');

?>