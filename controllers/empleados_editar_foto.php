<?php 
                include "../admin/includes/session.php";
                require_once "../models/empleados_model.php";
                $empleados = new empleados_model();
                
                if(isset($_POST['upload'])){
                    $empid = $_POST['id'];
                    $filename = $_FILES['photo']['name'];
                    if(!empty($filename)){
                        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
                    }
                     
                    $editar = $empleados-> editar_foto_empleados($empid, $filename); 

                    if(isset($_SESSION['error'])){

                        echo $_SESSION['error'];
        
                    }else{
                  
                        echo $_SESSION['success'];
                    
                    }
            
                }
                else{
                    $_SESSION['error'] = 'Error, intenta nuevamente';
                }
            
                header('location: ../admin/empleados.php');
?>