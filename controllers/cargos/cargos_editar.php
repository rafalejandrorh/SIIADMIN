<?php 
        include '../../controllers/sesion/session.php';
        include "../../config/conn.php";
        require_once "../../models/cargos_model.php";
        $cargos = new cargos_model();
                
        if(isset($_POST['editar'])){
            $id_cargo = $_POST['id'];
            $cargo = $_POST['cargo'];
            $sueldo = $_POST['sueldo'];
                     
            $editar = $cargos->editar_cargos($cargo, $sueldo, $id_cargo); 
            
        }else{

            $_SESSION['error'] = 'Error, Intenta actualizar el cargo nuevamente';

        }
            
        header('location: ../../admin/cargos/index.php');
?>