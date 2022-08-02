<?php 
        include '../../controllers/sesion/session.php';
        include "../../config/conn.php";
        require_once "../../models/deducciones_model.php";
        $deducciones = new deducciones_model();
                
        if(isset($_POST['guardar']))
        {
            $descripcion = $_POST['descripcion'];
            $monto = $_POST['monto'];
            $tabla = $_POST['tabla'];
            $insertar = $deducciones->insertar_deducciones($descripcion, $monto, $tabla); 
      
        }else{

            $_SESSION['error'] = 'Error, Intenta añadir las deducciones nuevamente';

        }
            header('location: ../../admin/deducciones/index.php');        

?>