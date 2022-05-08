<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, avancefectivo.id AS caid FROM avancefectivo LEFT JOIN empleados on empleados.id=avancefectivo.employee_id WHERE avancefectivo.id='$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>