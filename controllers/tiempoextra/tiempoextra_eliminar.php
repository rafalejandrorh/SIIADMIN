<?php 
        include '../../controllers/sesion/session.php';
        include "../../config/conn.php";
        require_once "../../models/tiempoextra_model.php";
        $tiempoextra = new tiempoextra_model();
                
        if(isset($_POST['eliminar']))
        {
            $id = $_POST['id'];
                     
            $eliminar = $tiempoextra->eliminar_tiempoextra($id); 

        }else{

            $_SESSION['error'] = 'Error, intenta nuevamente';

        }
            
        header('location: ../../admin/tiempoextra/index.php');
?>