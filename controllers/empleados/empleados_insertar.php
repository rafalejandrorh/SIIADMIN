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

            if(!empty($foto)){
                move_uploaded_file($_FILES['foto']['tmp_name'], '../../images'.$foto);	
            }

            $personas = new personas_model(); 
            $persona = $personas->validar_persona($cedula);

            if($persona >= 1)
            {
                header('location: ../../admin/empleados/index.php');
            }else{

                $id_persona = $personas->insertar_persona($cedula, $nombres, $apellidos, $direccion, $fecha_nacimiento, $numero_contacto, $genero, $foto);
            
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