<?php
        include '../../admin/includes/session.php';
        include "../../config/conn.php";
        require_once "../../models/avancefectivo_model.php";
        $avancefectivo = new avancefectivo_model();
                
        if(isset($_POST['edit']))
        {
            $id = $_POST['id'];
            $amount = $_POST['amount'];
                     
            $editar = $avancefectivo->editar_avancefectivo($amount, $id); 
            
        }else{

            $_SESSION['error'] = 'Error, Intenta actualizar el tiempo extra nuevamente';

         }
            
        header('location: ../../admin/avancefectivo/index.php');
?>