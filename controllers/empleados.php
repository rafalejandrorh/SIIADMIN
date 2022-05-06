<?php 

        require_once "../models/empleados_model.php";
        $empleados = new empleados_model();
        $data["titulo"] = "Empleados";
        $data = $empleados-> obtener_empleados(); 

?>