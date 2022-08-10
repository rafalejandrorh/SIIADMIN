<?php 
        include '../../controllers/sesion/session.php';
        require_once "../../models/usuarios_model.php";
        require_once "../../models/perfiles_model.php";
        $perfiles = new perfiles_model();
        $usuarios = new usuarios_model();

        if(isset($_POST['editar']))
        {
            $id_perfil = $_POST['id_perfil_antiguo'];
            $id_perfil_nuevo = $_POST['id_perfil_nuevo'];
            $perfil = $_POST['perfil'];
            $contraseña_admin = $_POST['contraseña_administrador'];
            $id_admin = $_POST['id_usuario_administrador'];

            $comprobacion_contraseña = $usuarios->validar_contraseña($id_admin, $contraseña_admin);
            if($comprobacion_contraseña == true)
            {
                $editar_usuario = $perfiles->editar_perfil($id_perfil_nuevo, $perfil, $id_perfil);
            }else{

                $_SESSION['error'] = 'Error, la Contraseña indicada no es correcta.';
                
            }    

        }else{
            $_SESSION['error'] = 'Error, intenta nuevamente';
        }
        header('location: ../../admin/perfiles/index.php');
            
?>