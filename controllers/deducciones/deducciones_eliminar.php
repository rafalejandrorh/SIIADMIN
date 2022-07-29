<?php 
        include '../../admin/includes/session.php';
        include "../../config/conn.php";
        require_once "../../models/deducciones_model.php";
        $deducciones = new deducciones_model();
                
        if(isset($_POST['delete']))
        {
            $id = $_POST['id'];
            $tabla = $_POST['tabla'];   
            $eliminar = $deducciones->eliminar_deducciones($id, $tabla); 
            
        }else{

            $_SESSION['error'] = 'Error, intenta nuevamente';

        }
            
        header('location: ../../admin/deducciones/index.php');
?>