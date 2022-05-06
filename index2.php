<?php 

require_once "config/conn.php";
require_once "controllers/empleados.php";

$control = new EmpleadosController();
$control -> index();

?>