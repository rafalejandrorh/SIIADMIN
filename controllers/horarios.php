<?php 

        require_once "../models/horarios_model.php";
        $horarios = new horarios_model();
        $data["titulo"] = "Horarios";
        $data = $empleados-> obtener_horarios(); 

?>