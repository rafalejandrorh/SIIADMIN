<?php 
        include '../../controllers/sesion/session.php';
        include "../../config/conn.php";
        require_once "../../models/empleados_model.php";
        require_once "../../models/personas_model.php";
        $empleados = new empleados_model();
        $personas = new personas_model();
                
        if(isset($_POST['editar']))
        {
            $id_empleado = $_POST['id_empleado'];
            $cedula = $_POST['cedula'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $direccion = $_POST['direccion'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $numero_contacto = $_POST['numero_contacto'];
            $genero = $_POST['genero'];
            $id_cargo = $_POST['cargo'];
            $id_horario = $_POST['horario'];
            
            $editar_empleado = $empleados->editar_empleado($id_empleado, $id_cargo, $id_horario);
            $id_persona = $personas->obtener_persona($id_empleado);
            $editar_persona = $personas->editar_persona_empleado($id_persona, $cedula, $nombres, $apellidos, $direccion, $fecha_nacimiento, $numero_contacto, $genero);

        }else{
            $_SESSION['error'] = 'Error, intenta nuevamente';
        }
        header('location: ../../admin/empleados/index.php');
            
?>