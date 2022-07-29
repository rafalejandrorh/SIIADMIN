<?php
        include '../../admin/includes/session.php'; 
        include "../../config/conn.php";
        require_once "../../models/avancefectivo_model.php";
        $avancefectivo = new avancefectivo_model();
                
        if(isset($_POST['delete']))
        {
            $id = $_POST['id'];
                     
            $eliminar = $avancefectivo->eliminar_avancefectivo($id); 
            
        }else{

            $_SESSION['error'] = 'Error, intenta nuevamente';

        }
            
        header('location: ../../admin/avancefectivo/index.php');
?>