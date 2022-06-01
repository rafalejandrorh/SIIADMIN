<?php 
        include "../../config/conn.php";
        require_once "../../models/tiempoextra_model.php";
        $tiempoextra = new tiempoextra_model();
                
        if(isset($_POST['add'])){
            $employee = $_POST['employee'];
            $date = $_POST['date'];
            $hours = $_POST['hours'];
            $rate = $_POST['rate'];
                    
            $insertar = $tiempoextra -> insertar_tiempoextra($employee, $date, $hours, $rate); 

            if(isset($_SESSION['error'])){

                echo $_SESSION['error'];

            }else{
          
                echo $_SESSION['success'];
            
            }
      
        }else{

            $_SESSION['error'] = 'Error, Intenta agregar el tiempo extra nuevamente';
            
        }
            
            header('location: ../../admin/tiempoextra/index.php');        

?>