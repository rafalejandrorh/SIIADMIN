<?php 

        include "../../config/conn.php";
        require_once "../../models/deducciones_model.php";
        $deducciones = new deducciones_model();
        $tabla_ivss = 'deducciones';
        $tabla_faov = 'deducciones2';
        $obtener_ivss = $deducciones->obtener_deducciones($tabla_ivss); 
        $obtener_faov = $deducciones->obtener_deducciones($tabla_faov);

        // if(isset($_POST['id']))
	// {
	// 	if($_POST['tabla'] == 'ivss')
	// 	{
	// 	$id = $_POST['id'];
	// 	$sql = "SELECT * FROM deducciones WHERE id = '$id'";
	// 	$query = $conn->query($sql);
	// 	$row = $query->fetch_assoc();
	// 	echo json_encode($row);
	// 	}else if($_POST['tabla'] == 'faov')
	// 	{
	// 	$id = $_POST['id'];
	// 	$sql = "SELECT * FROM deducciones2 WHERE id = '$id'";
	// 	$query = $conn->query($sql);
	// 	$row = $query->fetch_assoc();
	// 	echo json_encode($row);
	// 	}
	// }
        
?>