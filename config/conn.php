<?php

require_once('config_db.php');

    class Conexion extends PDO{

        private $tipo_de_base = DB_TYPE;
        private $host = DB_HOST;
        private $nombre_de_base = DB_NAMEDB;
        private $usuario = DB_USER;
        private $clave = DB_PASSWORD;
        private $puerto = DB_PORT;
        private $options;

        public function __construct()
        {
            try{
                $this->options= [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
                parent::__construct("{$this->tipo_de_base}:dbname={$this->nombre_de_base};port={$this->puerto};host={$this->host}", $this->usuario, $this->clave, $this->options );
            } catch (PDOException $e) {
                echo '<br><br>Ha surgido un error y no se puede conectar a la base de datos. Detalle: <br><br>' . $e->getMessage().'<br><br>';
            }
        }
    
        public static function DB_mySQL()
        {
           $conn = new mysqli('localhost', 'root', '', 'asistencia_nomina');
           return $conn; 
        }

    }

?>
