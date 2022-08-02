<?php 
        include '../../controllers/sesion/session.php';
        include "../../config/conn.php";
        require_once "../../models/avancefectivo_model.php";
        require_once "../../models/personas_model.php";
        require_once "../../models/empleados_model.php";
        $avancefectivo = new avancefectivo_model();
        $personas = new personas_model();
        $empleados = new empleados_model();
                
        if(isset($_POST['guardar'])){
            $cedula = $_POST['cedula'];
            $monto = $_POST['monto'];
            
            $id_persona = $personas->obtener_id_persona($cedula);

            if($id_persona >= 1)
            {

                $id_empleado = $empleados->obtener_empleado($id_persona);

                if($id_empleado >= 1)
                {

                    $insertar = $avancefectivo->insertar_avancefectivo($id_empleado, $monto); 
                    header('location: ../../admin/avancefectivo/index.php');

                }else{
                    header('location: ../../admin/avancefectivo/index.php');       
                }

            }else{
                header('location: ../../admin/avancefectivo/index.php');       
            }
      
        }else{

            $_SESSION['error'] = 'Error, Intenta añadir el avance de efectivo nuevamente';
            header('location: ../../admin/avancefectivo/index.php');   
                
        }
         

?>