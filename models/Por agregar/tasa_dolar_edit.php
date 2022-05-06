<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$rate_dolar = $_POST['rate_dolar'];

		$sql = "UPDATE tasa_dolar SET rate_dolar = '$rate_dolar' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Tasa del dólar modificada satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Verifique que el monto sea correcto y vuelva a intentarlo';
	}

	header('location:tasa_dolar.php');

?>