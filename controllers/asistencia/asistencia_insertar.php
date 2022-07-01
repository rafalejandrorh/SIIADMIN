<?php 
        include '../../admin/includes/session.php';
        require_once "../../config/conn.php";
        require_once "../../models/asistencia_model.php";
        $asistencia = new asistencia_model();
                
        if(isset($_POST['add'])){
            $employee = $_POST['employee'];
            $date = $_POST['date'];
            $in = $_POST['time_in'];
            $time_in = date('H:i:s', strtotime($in));
            $out = $_POST['time_out'];
            $time_out = date('H:i:s', strtotime($out));
                    
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