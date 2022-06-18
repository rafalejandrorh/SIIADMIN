<?php 
        include '../../admin/includes/session.php';
        include "../../config/conn.php";
        require_once "../../models/cargos_model.php";
        $cargos = new cargos_model();
                
        if(isset($_POST['edit'])){
            $id = $_POST['id'];
            $title = $_POST['title'];
            $rate = $_POST['rate'];
                     
            $editar = $cargos-> editar_cargos($title, $rate, $id); 

            if(isset($_SESSION['error'])){

                echo $_SESSION['error'];
        
            }else{
                  
                echo $_SESSION['success'];
                    
            }
            
        }
        else{
            $_SESSION['error'] = 'Error, Intenta actualizar el cargo nuevamente';
        }
            
        header('location: ../../admin/cargos/index.php');
?>