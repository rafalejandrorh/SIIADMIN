<?php 
        include '../../controllers/sesion/session.php';
        require_once "../../config/conn.php";
        require_once "../../models/horarios_model.php";
        $horarios = new horarios_model();

        if(isset($_POST['eliminar']))
        {
		$id_horario = $_POST['id'];
                $eliminar = $horarios->eliminar_horarios($id_horario); 

        }else{

                $_SESSION['error'] = 'Intenta eliminar el horario nuevamente';

        }

        header('location: ../../admin/horarios/index.php');

?>