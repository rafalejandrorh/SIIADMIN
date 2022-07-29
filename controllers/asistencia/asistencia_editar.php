<?php 
          include '../../admin/includes/session.php';
          require_once "../../config/conn.php";
          require_once "../../models/asistencia_model.php";
          $asistencia = new asistencia_model();
               
          if(isset($_POST['edit']))
          {
               $id = $_POST['id'];
               $date = $_POST['edit_date'];
               $time_in = $_POST['edit_time_in'];
               $time_in = date('H:i:s', strtotime($time_in));
               $time_out = $_POST['edit_time_out'];
               $time_out = date('H:i:s', strtotime($time_out));
                         
               $editar = $asistencia->editar_asistencia($date, $time_in, $time_out, $id); 
            
          }else{

               $_SESSION['error'] = 'Error, intente nuevamente';
                    
          }
            
          header('location: ../../admin/asistencia/index.php');
?>