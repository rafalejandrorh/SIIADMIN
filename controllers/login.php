<?php 
        include "../admin/includes/session.php";
        require_once "../models/login_model.php";
        $login = new login_model();

        if(isset($_POST['login'])){
            $username = $_POST['username'];
            $password = $_POST['password'];

            $iniciar = $login-> iniciar_login($username, $password); 

            header('location: ../admin/index.php');

        }
        else{
            $_SESSION['error'] = 'Primero ingrese sus credenciales de Administrador';
        }
    
        header('location: ../admin/index.php');
        
?>0