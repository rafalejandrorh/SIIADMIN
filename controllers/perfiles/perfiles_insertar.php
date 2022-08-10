<?php 
        include '../../controllers/sesion/session.php';
        require_once "../../models/perfiles_model.php";
        require_once "../../models/usuarios_model.php";
        $perfiles = new perfiles_model();
        $usuarios = new usuarios_model();
        
        if(isset($_POST['guardar']))
        {
            $id_perfil = $_POST['id_perfil'];
            $perfil = $_POST['perfil'];
            $contraseña_admin = $_POST['contraseña_administrador'];
            $id_admin = $_POST['id_usuario_administrador'];

            $comprobacion_contraseña = $usuarios->validar_contraseña($id_admin, $contraseña_admin);
            if($comprobacion_contraseña == true)
            {
                $comprobacion_perfil = $perfiles->validar_id_perfil($id_perfil);
                if($comprobacion_perfil == 0)
                {

                    $comprobacion_usuario = $perfiles->validar_perfil($perfil);
                    if($comprobacion_usuario == 0)
                    {
                        $insertar = $perfiles->insertar_perfil($id_perfil, $perfil);
                    }else{
                        $_SESSION['error'] = 'El nombre del Perfil ya se encuentra asignado.';
                    }

                }else{

                    $_SESSION['error'] = 'El ID de Perfil ya se encuentra asignado.';

                }

            }else{

                $_SESSION['error'] = 'La contraseña indicada no es correcta.';

            }     
        
        }else{

            $_SESSION['error'] = 'Error, intenta nuevamente';
            
        }
            
        header('location: ../../admin/perfiles/index.php');
                
?>