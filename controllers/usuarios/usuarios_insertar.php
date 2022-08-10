<?php 
        include '../../controllers/sesion/session.php';
        require_once "../../models/usuarios_model.php";
        $usuarios = new usuarios_model();
        
        if(isset($_POST['guardar']))
        {
            $id_persona = $_POST['id_persona'];
            $usuario = $_POST['usuario'];
            $contraseña = $_POST['contraseña'];
            $estatus_usuario = $_POST['estatus_usuario'];
            $id_admin = $_POST['id_usuario_administrador'];
            $contraseña_admin = $_POST['contraseña_administrador'];
            $id_perfil = $_POST['id_perfil'];
            $id_usuario = null;

            $comprobacion_persona = $usuarios->validar_persona_usuario($id_persona);
            if($comprobacion_persona == 0)
            {

                $comprobacion_contraseña = $usuarios->validar_contraseña($id_admin, $contraseña_admin);
                if($comprobacion_contraseña == true)
                {

                    $comprobacion_usuario = $usuarios->validar_usuario($usuario, $id_usuario);
                    if($comprobacion_usuario == 0)
                    {
                        $insertar = $usuarios->insertar_usuario($id_persona, $usuario, $estatus_usuario, $contraseña, $id_perfil);
                    }else{
                        $_SESSION['error'] = 'El Usuario indicado ya está en uso, por favor eliga otro.';
                    }

                }else{

                    $_SESSION['error'] = 'La Contraseña indicada no es correcta.';

                }

            }else{

                $_SESSION['error'] = 'Este Empleado ya posee un Usuario registrado.';

            }     
        
        }else{

            $_SESSION['error'] = 'Error, intenta nuevamente';
            
        }
            
        header('location: ../../admin/usuarios/index.php');
                
?>