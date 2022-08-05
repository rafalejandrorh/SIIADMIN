<?php 
        include '../../controllers/sesion/session.php';
        require_once "../../config/conn.php";
        require_once "../../models/usuarios_model.php";
        $usuarios = new usuarios_model();
                
        if(isset($_POST['eliminar']))
        {
            $id_usuario = $_POST['id_usuario'];
                     
            $eliminar = $usuarios->bloquear_usuario($id_usuario); 

            if($eliminar == 0)
            {
                $_SESSION['error'] = 'Error al bloquear al Usuario, intente más tarde.';
            }
            
        }else{

            $_SESSION['error'] = 'Error, intenta nuevamente';

        }
            
        header('location: ../../admin/usuarios/index.php');
?>