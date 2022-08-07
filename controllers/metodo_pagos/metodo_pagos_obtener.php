<?php 
        require_once "../../models/metodo_pagos_model.php";
        $metodo_pagos = new metodo_pagos_model();
        $obtener = $metodo_pagos->obtener_metodo_pagos();
?>