<?php 
        require_once "../../config/conn.php";
        require_once "../../models/horarios_model.php";
        $horarios = new horarios_model();

        if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$time_in = $_POST['time_in'];
		$time_in = date('H:i:s', strtotime($time_in));
		$time_out = $_POST['time_out'];
		$time_out = date('H:i:s', strtotime($time_out));

         $editar = $horarios-> editar_horarios($time_in, $time_out, $id); 

		 if(isset($_SESSION['error'])){

			echo $_SESSION['error'];

		}else{
	  
			echo $_SESSION['success'];
		
		}

	}
	else{
		$_SESSION['error'] = 'Intenta actualizar los horarios nuevamente';
	}

        header('location: ../../admin/horarios/horarios.php');

?>