<?php 
        include '../../admin/includes/session.php';
        require_once "../../config/conn.php";
        require_once "../../models/horarios_model.php";
        $horarios = new horarios_model();

        if(isset($_POST['add']))
        {
            $time_in = $_POST['time_in'];
            $time_in = date('H:i:s', strtotime($time_in));
            $time_out = $_POST['time_out'];
            $time_out = date('H:i:s', strtotime($time_out));

            $insertar = $horarios->insertar_horarios($time_in, $time_out); 

        }else{

            $_SESSION['error'] = 'Intenta agregar los horarios nuevamente';

        }

        header('location: ../../admin/horarios/index.php');

?>