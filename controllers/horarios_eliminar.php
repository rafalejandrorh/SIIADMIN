<?php 
        include "../admin/includes/session.php";
        require_once "../models/horarios_model.php";
        $horarios = new horarios_model();

        if(isset($_POST['delete'])){
		$id = $_POST['id'];

         $eliminar = $horarios-> eliminar_horarios($id); 

         if(isset($_SESSION['error'])){

                echo $_SESSION['error'];

            }else{
          
                echo $_SESSION['success'];
            
            }

        }	
        else{
                $_SESSION['error'] = 'Intenta eliminar el horario nuevamente';
        }

        header('location: ../admin/horarios.php');

?>