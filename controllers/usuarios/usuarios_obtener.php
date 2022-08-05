<?php 
        require_once "../../models/usuarios_model.php";
        require_once "../../models/personas_model.php";
        $personas = new personas_model();
        $usuarios = new usuarios_model();
        $obtener = $usuarios->obtener_usuarios();
        $personas = $personas->lista_personas();
?>