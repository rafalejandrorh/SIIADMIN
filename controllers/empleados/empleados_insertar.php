<?php 
        include '../../controllers/sesion/session.php';
        require_once "../../config/conn.php";
        require_once "../../models/empleados_model.php";
        require_once "../../models/personas_model.php";
        
        if(isset($_POST['guardar']))
        {
            $cedula = $_POST['cedula'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $direccion = $_POST['direccion'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $numero_contacto = $_POST['numero_contacto'];
            $genero = $_POST['genero'];
            $id_cargo = $_POST['cargo'];
            $id_horario = $_POST['horario'];
            $foto = $_FILES['foto']['name'];
            $foto_cedula = $_FILES['foto_cedula']['name'];
            $foto_rif = $_FILES['foto_rif']['name'];

            if(!empty($foto)){
                move_uploaded_file($_FILES['foto']['tmp_name'], '../../images/perfil/'.$foto);		
            }
            if(!empty($foto_cedula)){
                move_uploaded_file($_FILES['foto_cedula']['tmp_name'], '../../images/cedula/'.$foto_cedula);	
            }
            if(!empty($foto_rif)){	
                move_uploaded_file($_FILES['foto_rif']['tmp_name'], '../../images/rif/'.$foto_rif);	
            }

            $personas = new personas_model(); 
            $persona = $personas->validar_persona($cedula);

            if($persona >= 1)
            {
                $_SESSION['error'] = 'El empleado ya se encuentra registrado en el Sistema. Se realizó la reactivación del mismo.';
                header('location: ../../admin/empleados/index.php');
            }else{

                $id_persona = $personas->insertar_persona($cedula, $nombres, $apellidos, $direccion, $fecha_nacimiento, $numero_contacto, $genero, $foto, $foto_cedula, $foto_rif);
            
                    if($id_persona >= 1)
                    {

                        $empleados = new empleados_model();
                        $insertar = $empleados->insertar_empleado($id_persona, $id_cargo, $id_horario);

                    }else{
                        $_SESSION['error'] = 'Error al Ingresar el Empleado, intente más tarde.';
                    }

            }
        
        }else{

            $_SESSION['error'] = 'Error, intenta nuevamente';
            
        }
            
        header('location: ../../admin/empleados/index.php');
                
?>