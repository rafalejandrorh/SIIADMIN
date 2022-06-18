<?php 
        include '../../admin/includes/session.php';
        include "../../config/conn.php";
        require_once "../../models/deducciones_model.php";
        $deducciones = new deducciones_model();
                
        if(isset($_POST['edit'])){
            $id = $_POST['id'];
            $description = $_POST['description'];
            $amount = $_POST['amount'];
                    
            $editar = $deducciones-> editar_deducciones($description, $amount, $id); 

            if(isset($_SESSION['error'])){

                echo $_SESSION['error'];
        
            }else{
                  
                echo $_SESSION['success'];
                    
            }
            
        }
        else{
            $_SESSION['error'] = 'Error, Intenta actualizar la deducción nuevamente';
        }
            
        header('location: ../../admin/deducciones/index.php');
?>