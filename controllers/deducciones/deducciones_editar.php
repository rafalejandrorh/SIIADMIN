<?php 
        include '../../controllers/sesion/session.php';
        include "../../config/conn.php";
        require_once "../../models/deducciones_model.php";
        $deducciones = new deducciones_model();
                
        if(isset($_POST['editar']))
        {
            $id = $_POST['id'];
            $descripcion = $_POST['descripcion'];
            $monto = $_POST['monto'];
            $tabla = $_POST['tabla'];
            $editar = $deducciones->editar_deducciones($descripcion, $monto, $id, $tabla); 

        }else{

            $_SESSION['error'] = 'Error, Intenta actualizar la deducción nuevamente';
            
        }
            
        header('location: ../../admin/deducciones/index.php');
?>