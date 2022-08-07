<?php 
        include "../../models/asistencia_model.php";
        include "../../empleado/includes/timezone.php";
        include '../../controllers/sesion/session.php';
        $asistencia = new asistencia_model();

        if(isset($_POST['registrar']))
        {
            $cedula = $_POST['cedula'];
            $estatus_llegada = $_POST['status'];
			$fecha = date('Y-m-d');

            $buscarempleado = $asistencia->insertar_asistencia_empleado($cedula, $estatus_llegada, $fecha); 
            
        }else{

            $_SESSION['error'] = 'Error, intente de nuevo';
            
        }

            header('location: ../../empleado/asistencia/index.php');  

?>