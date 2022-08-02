<?php 
        include '../../controllers/sesion/session.php';
        include "../../config/conn.php";
        require_once "../../models/tiempoextra_model.php";
        require_once "../../models/personas_model.php";
        require_once "../../models/empleados_model.php";
        $tiempoextra = new tiempoextra_model();
        $personas = new personas_model();
        $empleados = new empleados_model();
                
        if(isset($_POST['guardar']))
        {
            $cedula = $_POST['cedula'];
            $fecha = $_POST['fecha'];
            $horas = $_POST['horas'];
            $monto = $_POST['monto'];
            
            $id_persona = $personas->obtener_id_persona($cedula);

            if($id_persona >= 1)
            {

                $id_empleado = $empleados->obtener_empleado($id_persona);

                if($id_empleado >= 1)
                {

                $insertar = $tiempoextra->insertar_tiempoextra($id_empleado, $fecha, $horas, $monto); 

                }else{
                    header('location: ../../admin/avancefectivo/index.php');       
                }

            }else{
                header('location: ../../admin/avancefectivo/index.php');       
            }
            
        }else{

            $_SESSION['error'] = 'Error, Intenta agregar el tiempo extra nuevamente';
            
        }
            
            header('location: ../../admin/tiempoextra/index.php');        

?>