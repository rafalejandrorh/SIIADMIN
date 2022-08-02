<?php 
        include '../../controllers/sesion/session.php';
        include "../../config/conn.php";
        require_once "../../models/cargos_model.php";
        $cargos = new cargos_model();
                
        if(isset($_POST['guardar'])){
            $cargo = $_POST['cargo'];
            $sueldo = $_POST['sueldo'];
                    
            $insertar = $cargos->insertar_cargos($cargo, $sueldo); 
      
        }else{

            $_SESSION['error'] = 'Error, Intenta añadir el cargo nuevamente';
            
        }
            
            header('location: ../../admin/cargos/index.php');        

?>