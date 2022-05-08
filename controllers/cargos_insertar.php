<?php 
        include "../admin/includes/session.php";
        require_once "../models/cargos_model.php";
        $cargos = new cargos_model();
                
        if(isset($_POST['add'])){
            $title = $_POST['title'];
            $rate = $_POST['rate'];
                    
            $insertar = $cargos -> insertar_cargos($title, $rate); 

            if(isset($_SESSION['error'])){

                echo $_SESSION['error'];

            }else{
          
                echo $_SESSION['success'];
            
            }
      
        }else{

            $_SESSION['error'] = 'Error, Intenta añadir el cargo nuevamente';
            
        }
            
            header('location: ../admin/cargos.php');        

?>