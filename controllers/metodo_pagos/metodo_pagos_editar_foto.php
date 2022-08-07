<?php 
        include '../../controllers/sesion/session.php';
        require_once "../../config/conn.php";
        require_once "../../models/empleados_model.php";
        require_once "../../models/persona_model.php";
        $empleados = new empleados_model();
        $personas = new personas_model();
                
        if(isset($_POST['subir']))
        {
            $id_empleado = $_POST['id_empleado'];
            $foto = $_FILES['photo']['name'];
            if(!empty($foto))
            {
                move_uploaded_file($_FILES['photo']['tmp_name'], '../../images/perfil/'.$foto);	
            }  
            
            $id_persona = $personas->obtener_persona($id_empleado);

            if($id_persona >= 1)
            {

                $editar = $empleados->editar_foto_empleados($id_persona, $foto); 

                if($editar == 0)
                {
                    $_SESSION['error'] = 'Error al Editar la foto del Empleado, intente más tarde.';
                }

            }else{

                $_SESSION['error'] = 'Error, No se encontró al Empleado indicado, intente más tarde.';

            }

        }else{

            $_SESSION['error'] = 'Error, intenta nuevamente';

        }
            
        header('location: ../../admin/empleados/index.php');