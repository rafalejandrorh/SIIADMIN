<?php 
        include '../../admin/includes/session.php';
        include "../../config/conn.php";
        require_once "../../models/tiempoextra_model.php";
        $tiempoextra = new tiempoextra_model();
                
        if(isset($_POST['edit'])){
            $id = $_POST['id'];
            $date = $_POST['date'];
            $hours = $_POST['hours'];
            $rate = $_POST['rate'];
                    
            $editar = $tiempoextra-> editar_tiempoextra($date, $hours, $rate, $id); 

            if(isset($_SESSION['error'])){

                echo $_SESSION['error'];
        
            }else{
                  
                echo $_SESSION['success'];
                    
            }
            
        }
        else{
            $_SESSION['error'] = 'Error, Intenta actualizar el tiempo extra nuevamente';
        }
            
        header('location: ../../admin/tiempoextra/index.php');
?>