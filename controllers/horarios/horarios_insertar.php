<?php 
        include '../../controllers/sesion/session.php';
        require_once "../../config/conn.php";
        require_once "../../models/horarios_model.php";
        $horarios = new horarios_model();

        if(isset($_POST['guardar']))
        {
            $hora_llegada = $_POST['hora_llegada'];
            $hora_llegada = date('H:i:s', strtotime($hora_llegada));
            $hora_salida = $_POST['hora_salida'];
            $hora_salida = date('H:i:s', strtotime($hora_salida));

            $insertar = $horarios->insertar_horarios($hora_llegada, $hora_salida); 

        }else{

            $_SESSION['error'] = 'Intenta agregar los horarios nuevamente';

        }

        header('location: ../../admin/horarios/index.php');

?>