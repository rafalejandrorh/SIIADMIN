<?php 
        require_once "../../models/sesion_model.php";
        require_once "../../models/usuarios_model.php";

        $sesion = new sesion_model();
        $usuarios = new usuarios_model();
        $usuarios_sistema = $usuarios->obtener_total_usuarios();
        $usuarios_habilitados = $usuarios->obtener_usuarios_habilitados();
        $usuarios_deshabilitados = $usuarios->obtener_usuarios_deshabilitados();
        $sesiones_abiertas = $sesion->sesiones_abiertas();
?>