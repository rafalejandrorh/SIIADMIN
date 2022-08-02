<?php 
        include '../../controllers/sesion/session.php';
        require_once "../../config/conn.php";
        require_once "../../models/empleados_model.php";
        $empleados = new empleados_model();
                
        if(isset($_POST['eliminar']))
        {
            $id_empleado = $_POST['id_empleado'];
                     
            $eliminar = $empleados->inactivar_empleado($id_empleado); 

            if($eliminar == 0)
            {
                $_SESSION['error'] = 'Error al Eliminar al Empleado, intente más tarde.';
            }
            
        }else{

            $_SESSION['error'] = 'Error, intenta nuevamente';

        }
            
        header('location: ../../admin/empleados/index.php');
?>