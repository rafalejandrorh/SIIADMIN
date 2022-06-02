<?php 
        require_once "../../config/conn.php";
        require_once "../../models/asistencia_model.php";
        $asistencia = new asistencia_model();
                
        if(isset($_POST['add'])){
            $employee = $_POST['employee'];
            $date = $_POST['date'];
            $time_in = $_POST['time_in'];
            $time_in = date('H:i:s', strtotime($time_in));
            $time_out = $_POST['time_out'];
            $time_out = date('H:i:s', strtotime($time_out));
                    
            $buscarempleado = $asistencia->insertar_asistencia($employee, $date, $time_in, $time_out);

            if(isset($_SESSION['error'])){

                echo $_SESSION['error'];

            }else{
          
                echo $_SESSION['success'];
            
            }
      
        }else{

            $_SESSION['error'] = 'Error, intente de nuevo';
            
        }
            
            header('location: ../../admin/asistencia/index.php');        

?>