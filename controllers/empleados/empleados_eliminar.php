<?php 
        include '../../admin/includes/session.php';
        require_once "../../config/conn.php";
        require_once "../../models/empleados_model.php";
        $empleados = new empleados_model();
                
        if(isset($_POST['delete']))
        {
            $id = $_POST['id'];
                     
            $eliminar = $empleados->eliminar_empleados($id); 
            
        }else{

            $_SESSION['error'] = 'Error, intenta nuevamente';

        }
            
        header('location: ../../admin/empleados/index.php');
?>