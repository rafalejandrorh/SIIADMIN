<?php 
                include "../admin/includes/session.php";
                require_once "../models/perfil_model.php";
                $perfil = new perfil_model();
                
                if(isset($_GET['return'])){
                    $return = $_GET['return'];
                    
                }
                else{
                    $return = '../admin/home.php';
                }
                     
                if(isset($_POST['save'])){
                    $curr_password = $_POST['curr_password'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $firstname = $_POST['firstname'];
                    $lastname = $_POST['lastname'];
                    $photo = $_FILES['photo']['name'];
                    if(password_verify($curr_password, $user['password'])){
                        if(!empty($photo)){
                            move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$photo);
                            $filename = $photo;	
                        }
                        else{
                            $filename = $user['photo'];
                        }
            
                        if($password == $user['password']){
                            $password = $user['password'];
                        }
                        else{
                            $password = password_hash($password, PASSWORD_DEFAULT);
                        }

                    $user_session = $user['id'];

                    $editar = $perfil-> editar_perfil($username, $password, $firstname, $lastname, $filename, $user_session); 

                    if(isset($_SESSION['error'])){

                        echo $_SESSION['error'];
        
                    }else{
                  
                        echo $_SESSION['success'];
                    
                    }
            
                }
		else{
			$_SESSION['error'] = 'Contraseña Incorrecta';
		}
	}
	else{
		$_SESSION['error'] = 'Rellene los detalles requeridos primero';
	}

	header('location: ../admin/'.$return);
?>