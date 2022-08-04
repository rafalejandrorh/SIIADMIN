<?php 
        include '../../controllers/sesion/session.php';
        require_once "../../config/conn.php";
        require_once "../../models/asistencia_model.php";
        $asistencia = new asistencia_model();
                
        if(isset($_POST['guardar']))
        {
            $cedula = $_POST['cedula'];
            $fecha = $_POST['fecha'];
            $llegada = $_POST['hora_llegada'];
            $hora_llegada = date('H:i:s', strtotime($llegada));
            $salida = $_POST['hora_salida'];
            $hora_salida = date('H:i:s', strtotime($salida));
                    
            $buscarempleado = $asistencia->insertar_asistencia($cedula, $fecha, $hora_llegada, $hora_salida);
      
        }else{

            $_SESSION['error'] = 'Error, intente de nuevo';
            
        }
            
            header('location: ../../admin/asistencia/index.php');        

?>