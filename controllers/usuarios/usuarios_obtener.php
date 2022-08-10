<?php 
        require_once "../../models/usuarios_model.php";
        require_once "../../models/personas_model.php";
        require_once "../../models/perfiles_model.php";
        $personas = new personas_model();
        $usuarios = new usuarios_model();
        $perfiles = new perfiles_model();
        $obtener = $usuarios->obtener_usuarios();
        $personas = $personas->lista_personas();
        $perfiles = $perfiles->lista_perfiles();
?>