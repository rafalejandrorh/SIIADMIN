<?php 
        include '../../controllers/sesion/session.php';
        include "../../config/conn.php";
        require_once "../../models/tiempoextra_model.php";
        $tiempoextra = new tiempoextra_model();
                
        if(isset($_POST['editar']))
        {
            $id = $_POST['id'];
            $fecha = $_POST['fecha'];
            $horas = $_POST['horas'];
            $monto = $_POST['monto'];
                    
            $editar = $tiempoextra->editar_tiempoextra($fecha, $horas, $monto, $id); 
            
        }else{

            $_SESSION['error'] = 'Error, Intenta actualizar el tiempo extra nuevamente';

        }
            
        header('location: ../../admin/tiempoextra/index.php');
?>