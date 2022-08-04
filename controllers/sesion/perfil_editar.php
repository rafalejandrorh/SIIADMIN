<?php
include '../../controllers/sesion/session.php';
require_once "../../models/perfil_model.php";
require_once "../../models/personas_model.php";
$perfil = new perfil_model();
$personas = new personas_model();

if (isset($_GET['return'])) {
    $return = $_GET['return'];
} else {

    $return = '../admin/home/index.php';
}

if (isset($_POST['guardar'])) {
    $curr_contraseña = $_POST['curr_contraseña'];
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $foto = $_FILES['foto']['name'];
    if (password_verify($curr_contraseña, $_SESSION['contraseña'])) {
        if (!empty($foto)) {
            move_uploaded_file($_FILES['foto']['tmp_name'], '../images/perfil/' . $foto);
            $filename = $foto;
        } else {
            $filename = $_SESSION['foto'];
        }

        if ($contraseña == $_SESSION['contraseña']) {
            $contraseña = $_SESSION['contraseña'];
        } else {
            $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
        }

        $id_usuario = $_SESSION['id_usuario'];
        $id_persona = $_SESSION['id_persona'];
        $editar_persona = $personas->editar_persona_usuario($id_persona, $nombres, $apellidos, $foto);
        $editar = $perfil->editar_perfil($usuario, $contraseña, $id_usuario);
    } else {
        $_SESSION['error'] = 'Contraseña Incorrecta';
    }
} else {
    $_SESSION['error'] = 'Rellene los detalles requeridos primero';
}

header('location: ../../admin/home/' . $return);
