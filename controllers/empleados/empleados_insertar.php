<?php 
        include '../../admin/includes/session.php';
        require_once "../../config/conn.php";
        require_once "../../models/empleados_model.php";
        $empleados = new empleados_model();
               
        if(isset($_POST['add'])){
            $employee_id = $_POST['id'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $address = $_POST['address'];
            $birthdate = $_POST['birthdate'];
            $contact = $_POST['contact'];
            $gender = $_POST['gender'];
            $position = $_POST['position'];
            $schedule = $_POST['schedule'];
            $filename = $_FILES['photo']['name'];

            if(!empty($filename)){
                move_uploaded_file($_FILES['photo']['tmp_name'], '../../images'.$filename);	
            }
            $insertar = $empleados->insertar_empleados($employee_id, $firstname, $lastname, $address, $birthdate, $contact, $gender, $position, $schedule, $filename); 
        }
        else{
            $_SESSION['error'] = 'Error, intenta nuevamente';
        }
            
        header('location: ../../admin/empleados/index.php');
                
?>