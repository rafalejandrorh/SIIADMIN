<?php 
        include '../../controllers/sesion/session.php';
        include "../../config/conn.php";
        require_once "../../models/tasadolar_model.php";
        $tasadolar = new tasadolar_model();
                
        if(isset($_POST['editar']))
        {
            $id = $_POST['id'];
            $tasa_dolar = $_POST['tasa_dolar'];
                     
            $editar = $tasadolar->editar_tasadolar($tasa_dolar, $id); 
            
        }else{

            $_SESSION['error'] = 'Verifique que el monto sea correcto y vuelva a intentarlo';
            
        }
            
        header('location: ../../admin/tasadolar/index.php');
?>