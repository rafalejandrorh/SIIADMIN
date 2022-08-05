<?php 
        require_once "../../config/conn.php";  
        require_once "../../models/sesion_model.php";

        $login = new sesion_model();

        if(isset($_POST['login']))
        {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $iniciar = $login->iniciar_sesion($username, $password); 
            if(isset($_SESSION['login_exitoso']))
            {
                $historial = $login->historial_login($_SESSION['id_usuario'], $_SESSION['IP']);
                $_SESSION['id_historial'] = $historial;
                header('location: ../../admin/home/administracion.php');
            }
        }    
?>