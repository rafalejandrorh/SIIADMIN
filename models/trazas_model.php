<?php
require_once('conexion.clase.php');

class Trazas_auditoria
{

    public function __construct()
    {
        $this->conexion_bd = new conexion;
    }

    //////////////////////////////////////////////************ TRAZAS ****************////////////////////////////////////////////////

    public function trazas_administracion($tabla, $idusuario, $idaccion, $idpersona, $atributo, $ip)
    {
        $this->atributo = $atributo;
        $renoas = '"RENOAS"';
        $sql = "INSERT INTO $renoas.$tabla(idusuario, idaccion, idpersona, atributo, fecha, ip)VALUES($idusuario, $idaccion, $idpersona, :atributo, CURRENT_TIMESTAMP, '$ip')";
        $result = $this->conexion_bd->prepare($sql);
        $result->execute(array(':atributo' => $this->atributo));
        return array(0, "mensaje" => "Traza Registrada", $result); //Devuelve 0 indicando que hubo un registro y la id del registro
    }

    public function trazas_gestion($tabla, $idusuario, $idaccion, $idbien, $atributo, $ip)
    {
        $this->atributo = $atributo;
        $renoas = '"RENOAS"';
        $sql = "INSERT INTO $renoas.$tabla(idusuario, idaccion, idbien, atributo, fecha, ip)VALUES($idusuario, $idaccion, $idbien, :atributo, CURRENT_TIMESTAMP, '$ip')";
        $result = $this->conexion_bd->prepare($sql);
        $result->execute(array(':atributo' => $this->atributo));
        return array(0, "mensaje" => "Traza Registrada", $result); //Devuelve 0 indicando que hubo un registro y la id del registro
    }

    public function verTrazasAdministracion($limit, $apartir, $filtro)
    {
        $sqlFiltro = null;

        if (@$filtro['desde'] != 0 || @$filtro['hasta'] != 0) {
            $sqlFiltro = "WHERE trasa_administracion.fecha BETWEEN '" . $filtro['desde'] . "' AND '" . $filtro['hasta'] . "'";
        }
        if (@$filtro['usuario'] != 0) {
            $sqlFiltro = $sqlFiltro . 'AND trasa_administracion.idusuario = ' . @$filtro['usuario'];
        }
        if (@$filtro['accion'] != 0) {
            $sqlFiltro = $sqlFiltro . 'AND trasa_administracion.idaccion = ' . $filtro['accion'];
        }

        $renoas = '"RENOAS"';
        $sql = "SELECT usuario.usuario AS user, idaccion.nombre AS accion, persona.cedula, trasa_administracion.fecha, trasa_administracion.atributo, trasa_administracion.IP 
                FROM $renoas.trasa_administracion
                INNER JOIN $renoas.usuario ON trasa_administracion.idusuario = usuario.idusuario
                INNER JOIN $renoas.nomenclador idaccion ON trasa_administracion.idaccion = idaccion.idnomenclador
                INNER JOIN $renoas.persona ON trasa_administracion.idpersona = persona.idpersona
                $sqlFiltro 
                ORDER BY trasa_administracion.fecha DESC
                LIMIT $limit OFFSET $apartir";
        $result = $this->conexion_bd->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ContadorPaginacion_Administracion($filtro)
    {
        $sqlFiltro = null;

        if (@$filtro['desde'] != 0 || @$filtro['hasta'] != 0) {
            $sqlFiltro = "WHERE trasa_administracion.fecha BETWEEN '" . $filtro['desde'] . "' AND '" . $filtro['hasta'] . "'";
        }
        if (@$filtro['usuario'] != 0) {
            $sqlFiltro = $sqlFiltro . 'AND idusuario = ' . @$filtro['usuario'];
        }
        if (@$filtro['accion'] != 0) {
            $sqlFiltro = $sqlFiltro . 'AND idaccion = ' . $filtro['accion'];
        }

        $renoas = '"RENOAS"';
        $sql = "SELECT COUNT(id) AS n FROM $renoas.trasa_administracion $sqlFiltro";
        $result = $this->conexion_bd->query($sql);
        $dato = $result->fetch(PDO::FETCH_ASSOC);
        if ($result->rowCount() > 0) {
            return $dato['n'];
        } else {
            return 0;
        }
    }

    public function Buscador_administracion($idpersona)
    {
        $renoas = '"RENOAS"';
        $sql = "SELECT usuario.usuario AS user, idaccion.nombre AS accion, persona.cedula, trasa_administracion.fecha, trasa_administracion.atributo, trasa_administracion.IP FROM $renoas.trasa_administracion
        INNER JOIN $renoas.usuario ON trasa_administracion.idusuario = usuario.idusuario
        INNER JOIN $renoas.nomenclador idaccion ON trasa_administracion.idaccion = idaccion.idnomenclador
        INNER JOIN $renoas.persona ON trasa_administracion.idpersona = persona.idpersona
        WHERE trasa_administracion.idpersona = $idpersona";
        $result = $this->conexion_bd->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verTrazasGestion($limit, $apartir, $filtro)
    {
        $sqlFiltro = null;

        if (@$filtro['desde'] != 0 || @$filtro['hasta'] != 0) {
            $sqlFiltro = "WHERE trasa_gestion.fecha BETWEEN '" . $filtro['desde'] . "' AND '" . $filtro['hasta'] . "'";
        }
        if (@$filtro['usuario'] != 0) {
            $sqlFiltro = $sqlFiltro . 'AND trasa_gestion.idusuario = ' . @$filtro['usuario'];
        }
        if (@$filtro['accion'] != 0) {
            $sqlFiltro = $sqlFiltro . 'AND trasa_gestion.idaccion = ' . $filtro['accion'];
        }

        $renoas = '"RENOAS"';
        $sql = "SELECT usuario.usuario AS user, idaccion.nombre AS accion, idbien.n_bien AS bien, trasa_gestion.fecha, trasa_gestion.atributo, trasa_gestion.IP FROM $renoas.trasa_gestion
        INNER JOIN $renoas.usuario ON trasa_gestion.idusuario = usuario.idusuario
        INNER JOIN $renoas.nomenclador idaccion ON trasa_gestion.idaccion = idaccion.idnomenclador
        INNER JOIN $renoas.bienes idbien ON trasa_gestion.idbien = idbien.idbien
                $sqlFiltro 
                ORDER BY trasa_gestion.fecha DESC
                LIMIT $limit OFFSET $apartir";
        $result = $this->conexion_bd->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ContadorPaginacion_Gestion($filtro)
    {
        $sqlFiltro = null;

        if (@$filtro['desde'] != 0 || @$filtro['hasta'] != 0) {
            $sqlFiltro = "WHERE trasa_gestion.fecha BETWEEN '" . $filtro['desde'] . "' AND '" . $filtro['hasta'] . "'";
        }
        if (@$filtro['usuario'] != 0) {
            $sqlFiltro = $sqlFiltro . 'AND idusuario = ' . @$filtro['usuario'];
        }
        if (@$filtro['accion'] != 0) {
            $sqlFiltro = $sqlFiltro . 'AND idaccion = ' . $filtro['accion'];
        }

        $renoas = '"RENOAS"';
        $sql = "SELECT COUNT(id) AS n FROM $renoas.trasa_gestion $sqlFiltro";
        $result = $this->conexion_bd->query($sql);
        $dato = $result->fetch(PDO::FETCH_ASSOC);
        if ($result->rowCount() > 0) {
            return $dato['n'];
        } else {
            return 0;
        }
    }

    public function Buscador_Gestion($idbien)
    {
        $renoas = '"RENOAS"';
        $sql = "SELECT usuario.usuario AS user, idaccion.nombre AS accion, persona.cedula, trasa_gestion.fecha, trasa_gestion.atributo, trasa_gestion.IP FROM $renoas.trasa_gestion
        INNER JOIN $renoas.usuario ON trasa_gestion.idusuario = usuario.idusuario
        INNER JOIN $renoas.nomenclador idaccion ON trasa_gestion.idaccion = idaccion.idnomenclador
        INNER JOIN $renoas.bienes idbien ON trasa_gestion.idbien = idbien.idbien
        WHERE trasa_gestion.idbien = $idbien";
        $result = $this->conexion_bd->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verTrazasSesion($limit, $apartir, $filtro)
    {
        $sqlFiltro = null;

        if (@$filtro['desde_login'] != 0 || @$filtro['hasta_login'] != 0) {
            $sqlFiltro = "WHERE historial_sesion.fecha_login BETWEEN '" . $filtro['desde_login'] . "' AND '" . $filtro['hasta_login'] . "'";
        }
        if (@$filtro['desde_hasta'] != 0 || @$filtro['hasta_hasta'] != 0) {
            $sqlFiltro = "AND historial_sesion.fecha_logout BETWEEN '" . $filtro['desde_logout'] . "' AND '" . $filtro['hasta_logout'] . "'";
        }
        if (@$filtro['usuario'] != 0) {
            $sqlFiltro = $sqlFiltro . 'AND historial_sesion.idusuario = ' . @$filtro['usuario'];
        }
        // if (@$filtro['accion'] != 0) {
        //     $sqlFiltro = $sqlFiltro . ' AND historial_sesion.tipo_logout = ' . $filtro['accion'];
        // }

        $renoas = '"RENOAS"';
        $sql = "SELECT usuario.usuario AS user, historial_sesion.fecha_login AS login, historial_sesion.fecha_logout AS logout, historial_sesion.tipo_logout, historial_sesion.IP
                FROM $renoas.historial_sesion
                INNER JOIN $renoas.usuario ON historial_sesion.idusuario = usuario.idusuario 
                $sqlFiltro ORDER BY historial_sesion.fecha_login DESC LIMIT $limit OFFSET $apartir";
        $result = $this->conexion_bd->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ContadorPaginacion_Sesion($filtro)
    {
        $sqlFiltro = null;

        if (@$filtro['desde_login'] != 0 || @$filtro['hasta_login'] != 0) {
            $sqlFiltro = "WHERE historial_sesion.fecha_login BETWEEN '" . $filtro['desde_login'] . "' AND '" . $filtro['hasta_login'] . "'";
        }
        if (@$filtro['desde_hasta'] != 0 || @$filtro['hasta_hasta'] != 0) {
            $sqlFiltro = "AND historial_sesion.fecha_logout BETWEEN '" . $filtro['desde_logout'] . "' AND '" . $filtro['hasta_logout'] . "'";
        }
        if (@$filtro['usuario'] != 0) {
            $sqlFiltro = $sqlFiltro . 'AND historial_sesion.idusuario = ' . @$filtro['usuario'];
        }
        // if (@$filtro['accion'] != 0) {
        //     $sqlFiltro = $sqlFiltro . ' AND historial_sesion.tipo_logout = ' . $filtro['accion'];
        // }

        $renoas = '"RENOAS"';
        $sql = "SELECT COUNT(id) AS n FROM $renoas.historial_sesion $sqlFiltro";
        $result = $this->conexion_bd->query($sql);
        $dato = $result->fetch(PDO::FETCH_ASSOC);
        if ($result->rowCount() > 0) {
            return $dato['n'];
        } else {
            return 0;
        }
    }

    public function Accion_Trazas()
    {
        $idnomenclador = 15;
        $renoas = '"RENOAS"';
        $sql = "SELECT idnomenclador, nombre FROM $renoas.nomenclador WHERE tipo = $idnomenclador";
        $result = $this->conexion_bd->query($sql);
        $dato = $result->fetchAll();
        return $dato;
    }

    public function Usuarios()
    {
        $renoas = '"RENOAS"';
        $sql = "SELECT idusuario, usuario FROM $renoas.usuario";
        $result = $this->conexion_bd->query($sql);
        $dato = $result->fetchAll();
        return $dato;
    }
}
