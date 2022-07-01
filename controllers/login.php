<?php 
        require_once "../config/conn.php";  
        require_once "../models/login_model.php";

        $login = new login_model();

        session_start();
        if(isset($_POST['login'])){
            $username = $_POST['username'];
            $password = $_POST['password'];

            $iniciar = $login->iniciar_login($username, $password); 

            if(isset($_SESSION['error'])){

                echo $_SESSION['error'];

            }else{

                header('location: http://localhost/Sistema-MVC/admin/home.php');
            
            }

        }else{

            $_SESSION['error'] = 'Error, intente de nuevo';

        }
    
        header('location: http://localhost/Sistema-MVC/admin/index.php');
        
?>