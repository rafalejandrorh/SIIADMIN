<?php 
        include '../../controllers/sesion/session.php';
        require_once "../../models/perfiles_model.php";
        $perfiles = new perfiles_model();
                
        if(isset($_POST['eliminar']))
        {
            $id_perfil = $_POST['id_perfil'];
                     
            $eliminar = $perfiles->eliminar_perfil($id_perfil); 
            
        }else{

            $_SESSION['error'] = 'Error, intenta nuevamente';

        }
            
        header('location: ../../admin/perfiles/index.php');
?>