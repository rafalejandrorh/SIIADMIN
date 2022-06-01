<?php 
                require_once "../../config/conn.php";
                require_once "../../models/asistencia_model.php";
                $asistencia = new asistencia_model();
                
                if(isset($_POST['delete'])){
                    $id = $_POST['id'];
                     
                    $eliminar = $asistencia-> eliminar_asistencia($id); 

                    if(isset($_SESSION['error'])){

                        echo $_SESSION['error'];
        
                    }else{
                  
                        echo $_SESSION['success'];
                    
                    }
            
                }
                else{
                    $_SESSION['error'] = 'Seleccione la asistencia que desea eliminar';
                }
            
                header('location: ../../admin/asistencia/index.php');
?>