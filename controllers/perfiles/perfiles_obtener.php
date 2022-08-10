<?php 
        require_once "../../models/perfiles_model.php";
        $perfiles = new perfiles_model();
        $obtener = $perfiles->obtener_perfiles();

?>