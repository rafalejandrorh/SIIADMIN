<?php 
        include '../../controllers/sesion/session.php';
		require_once "../../config/conn.php";
        require_once "../../models/horarios_model.php";
        $horarios = new horarios_model();

        if(isset($_POST['editar']))
		{
			$id_horario = $_POST['id'];
			$hora_llegada = $_POST['hora_llegada'];
			$hora_llegada = date('H:i:s', strtotime($hora_llegada));
			$hora_salida = $_POST['hora_salida'];
			$hora_salida = date('H:i:s', strtotime($hora_salida));

			$editar = $horarios->editar_horarios($hora_llegada, $hora_salida, $id_horario); 

		}else{

			$_SESSION['error'] = 'Intenta actualizar los horarios nuevamente';

		}

        header('location: ../../admin/horarios/index.php');

?>