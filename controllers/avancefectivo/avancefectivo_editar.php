<?php
        include '../../controllers/sesion/session.php';
        include "../../config/conn.php";
        require_once "../../models/avancefectivo_model.php";
        $avancefectivo = new avancefectivo_model();
                
        if(isset($_POST['editar']))
        {
            $id = $_POST['id'];
            $monto = $_POST['monto'];
                     
            $editar = $avancefectivo->editar_avancefectivo($monto, $id); 
            
        }else{

            $_SESSION['error'] = 'Error, Intenta actualizar el tiempo extra nuevamente';

         }
            
        header('location: ../../admin/avancefectivo/index.php');
?>