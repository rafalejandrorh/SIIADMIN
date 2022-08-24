<?php 
        include '../../controllers/sesion/session.php';
        require_once "../../config/conn.php";
        require_once "../../models/empleados_model.php";
        require_once "../../models/personas_model.php";
        $empleados = new empleados_model();
        $personas = new personas_model();

        if(isset($_POST['subir']))
        {
            $id_empleado = $_POST['id_empleado'];
            if(!empty($_FILES['foto_nueva']['name']))
            {
                $foto = $_FILES['foto_nueva']['name'];
            }else{
                $foto = $_POST['foto_actual'];
            }
            if(!empty($_FILES['foto_nueva_cedula']['name']))
            {
                $foto_cedula = $_FILES['foto_nueva_cedula']['name'];
            }else{
                $foto_cedula = $_POST['foto_actual_cedula'];
            }
            if(!empty($_FILES['foto_nueva_rif']['name']))
            {
                $foto_rif = $_FILES['foto_nueva_rif']['name'];
            }else{
                $foto_rif = $_POST['foto_actual_rif'];
            }

            if(!empty($foto))
            {
                move_uploaded_file($_FILES['foto']['tmp_name'], '../../images/perfil/'.$foto);	
            }
            if(!empty($foto_cedula))
            {
                move_uploaded_file($_FILES['foto_cedula']['tmp_name'], '../../images/cedula/'.$foto_cedula);	
            }  
            if(!empty($foto_rif))
            {
                move_uploaded_file($_FILES['foto_rif']['tmp_name'], '../../images/rif/'.$foto_rif);	
            }    
            
            $id_persona = $personas->obtener_persona($id_empleado);

            if($id_persona >= 1)
            {

                $editar = $empleados->editar_foto_empleados($id_persona, $foto, $foto_cedula, $foto_rif); 

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