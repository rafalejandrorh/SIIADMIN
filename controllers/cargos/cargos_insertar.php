<?php 
        include '../../admin/includes/session.php';
        include "../../config/conn.php";
        require_once "../../models/cargos_model.php";
        $cargos = new cargos_model();
                
        if(isset($_POST['add'])){
            $title = $_POST['title'];
            $rate = $_POST['rate'];
                    
            $insertar = $cargos->insertar_cargos($title, $rate); 
      
        }else{

            $_SESSION['error'] = 'Error, Intenta añadir el cargo nuevamente';
            
        }
            
            header('location: ../../admin/cargos/index.php');        

?>