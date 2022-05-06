<?php

    class Conectar {

        public static function conexion()
        {

           $conn = new mysqli('localhost', 'root', '', 'asistencia_nomina');
           return $conn; 

        }

    }

?>