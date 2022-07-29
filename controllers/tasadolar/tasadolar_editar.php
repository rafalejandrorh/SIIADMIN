<?php 
        include '../../admin/includes/session.php';
        include "../../config/conn.php";
        require_once "../../models/tasadolar_model.php";
        $tasadolar = new tasadolar_model();
                
        if(isset($_POST['edit']))
        {
            $id = $_POST['id'];
            $rate_dolar = $_POST['rate_dolar'];
            $observaciones = $_POST['observaciones'];
                     
            $editar = $tasadolar->editar_tasadolar($rate_dolar, $id, $observaciones); 
            
        }else{

            $_SESSION['error'] = 'Verifique que el monto sea correcto y vuelva a intentarlo';
            
        }
            
        header('location: ../../admin/tasadolar/index.php');
?>