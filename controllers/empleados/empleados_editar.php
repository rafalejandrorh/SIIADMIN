<?php 
                include "../../config/conn.php";
                require_once "../../models/empleados_model.php";
                $empleados = new empleados_model();
                
                if(isset($_POST['edit'])){
                    $empid = $_POST['id'];
                    $firstname = $_POST['firstname'];
                    $lastname = $_POST['lastname'];
                    $address = $_POST['address'];
                    $birthdate = $_POST['birthdate'];
                    $contact = $_POST['contact'];
                    $gender = $_POST['gender'];
                    $position = $_POST['position'];
                    $schedule = $_POST['schedule'];
                     
                    $editar = $empleados-> editar_empleados($empid, $firstname, $lastname, $address, $birthdate, $contact, $gender, $position, $schedule); 

                    if(isset($_SESSION['error'])){

                        echo $_SESSION['error'];
        
                    }else{
                  
                        echo $_SESSION['success'];
                    
                    }
            
                }
                else{
                    $_SESSION['error'] = 'Error, intenta nuevamente';
                }
            
                header('location: ../../admin/empleados/empleados.php');
?>