<?php 
        include "../../config/conn.php";
        require_once "../../models/deducciones_model.php";
        $deducciones = new deducciones_model();
                
        if(isset($_POST['add'])){
            $description = $_POST['description'];
            $amount = $_POST['amount'];
                    
            $insertar = $deducciones -> insertar_deducciones($description, $amount); 

            if(isset($_SESSION['error'])){

                echo $_SESSION['error'];

            }else{
          
                echo $_SESSION['success'];
            
            }
      
        }else{

            $_SESSION['error'] = 'Error, Intenta añadir las deducciones nuevamente';
            
        }
            
            header('location: ../../admin/deducciones/index.php');        

?>