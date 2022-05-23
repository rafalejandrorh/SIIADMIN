<?php 
                include "../admin/includes/session.php";
                require_once "../models/deducciones_model.php";
                $deducciones = new deducciones_model();
                
                if(isset($_POST['delete'])){
                    $id = $_POST['id'];
                     
                    $eliminar = $deducciones-> eliminar_deducciones2($id); 

                    if(isset($_SESSION['error'])){

                        echo $_SESSION['error'];
        
                    }else{
                  
                        echo $_SESSION['success'];
                    
                    }
            
                }
                else{
                    $_SESSION['error'] = 'Error, intenta nuevamente';
                }
            
                header('location: ../admin/deducciones.php');
?>