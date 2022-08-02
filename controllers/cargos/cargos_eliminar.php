<?php 
        include '../../controllers/sesion/session.php';
        include "../../config/conn.php";
        require_once "../../models/cargos_model.php";
        $cargos = new cargos_model();
                
        if(isset($_POST['delete'])){
            $id_cargo = $_POST['id'];
                     
            $eliminar = $cargos->eliminar_cargos($id_cargo); 
            
        }else{

            $_SESSION['error'] = 'Error, intenta eliminar el cargo nuevamente';

        }
            
        header('location: ../../admin/cargos/index.php');
?>