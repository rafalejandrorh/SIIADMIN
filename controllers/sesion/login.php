<?php 
        require_once "../../config/conn.php";  
        require_once "../../models/sesion_model.php";

        $login = new sesion_model();

        if(isset($_POST['login']))
        {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $iniciar = $login->iniciar_login($username, $password); 
            if(isset($_SESSION['login_exitoso']))
            {
                header('location: ../../admin/home/index.php');
            }
        }    
?>