<?php 
        include '../../controllers/sesion/session.php';
        require_once "../../models/usuarios_model.php";
        $usuarios = new usuarios_model();
                
        if(isset($_POST['editar']))
        {
            $id_usuario = $_POST['id_usuario'];
            $usuario = $_POST['usuario'];
            $contraseña = $_POST['contraseña'];
            $estatus_usuario = $_POST['estatus_usuario'];
            $id_admin = $_POST['id_usuario_administrador'];
            $contraseña_admin = $_POST['contraseña_administrador'];

            $comprobacion_contraseña = $usuarios->validar_contraseña($id_admin, $contraseña_admin);
            if($comprobacion_contraseña == true)
            {

                $comprobacion_usuario = $usuarios->validar_usuario($usuario, $id_usuario);
                if($comprobacion_usuario == 0)
                {
                    $editar_usuario = $usuarios->editar_usuario($id_usuario, $usuario, $estatus_usuario, $contraseña);
                }else{
                    $_SESSION['error'] = 'El Usuario indicado ya está en uso, por favor eliga otro.';
                }

            }else{

                $_SESSION['error'] = 'Error, la Contraseña indicada no es correcta.';
                
            }    

        }else{
            $_SESSION['error'] = 'Error, intenta nuevamente';
        }
        header('location: ../../admin/usuarios/index.php');
            
?>