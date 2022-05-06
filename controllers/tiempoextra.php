<?php 

        require_once "../models/tiempoextra_model.php";
        $tiempoextra = new tiempoextra_model();
        $data["titulo"] = "tiempoextra";
        $data = $tiempoextra-> obtener_tiempoextra(); 

?>