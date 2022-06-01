<?php 
        include "../../config/conn.php";
        require_once "../../models/avancefectivo_model.php";
        $avancefectivo = new avancefectivo_model();
                
        if(isset($_POST['add'])){
            $employee = $_POST['employee'];
            $amount = $_POST['amount'];
                    
            $insertar = $avancefectivo -> insertar_avancefectivo($employee, $amount); 

            if(isset($_SESSION['error'])){

                echo $_SESSION['error'];

            }else{
          
                echo $_SESSION['success'];
            
            }
      
        }else{

            $_SESSION['error'] = 'Error, Intenta añadir el avance de efectivo nuevamente';
            
        }
            
            header('location: ../../admin/avancefectivo/index.php');        

?>