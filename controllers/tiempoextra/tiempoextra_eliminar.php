<?php 
                include "../../config/conn.php";
                require_once "../../models/tiempoextra_model.php";
                $tiempoextra = new tiempoextra_model();
                
                if(isset($_POST['delete'])){
                    $id = $_POST['id'];
                     
                    $eliminar = $tiempoextra-> eliminar_tiempoextra($id); 

                    if(isset($_SESSION['error'])){

                        echo $_SESSION['error'];
        
                    }else{
                  
                        echo $_SESSION['success'];
                    
                    }
            
                }
                else{
                    $_SESSION['error'] = 'Error, intenta nuevamente';
                }
            
                header('location: ../../admin/tiempoextra/index.php');
?>