<?php
	header('content-type:application/xls');
	header('content-Disposition: attachment; filename=Empleados Asistentes Hoy.xls');

    include '../../controllers/sesion/session.php';
    require_once "../../controllers/home/reportes_administracion.php";
?>
		
		<table>
		<thead>
            <th class="">Fecha</th>
            <th class="">Cédula de Identidad</th>
            <th class="">Nombre Completo</th>
            <th class="">Cargo</th>
            <th class="">Hora de Entrada</th>
            <th class="">Hora de Salida</th>
            <th class="">Horas Laboradas</th>
        </thead>
		<tbody>	
		    <?php
                foreach($asistentes_hoy as $row)
                {
                $status = ($row['estatus_llegada'])?'<span class="label label-warning pull-right">A tiempo</span>':'<span class="label label-danger pull-right">Tarde</span>';
            ?>
                <tr>
                <td><?php echo date('d M, Y', strtotime($row['fecha']))?></td>
                <td><?php echo $row['cedula']?></td>
                <td><?php echo $row['nombres'].', '.$row['apellidos']?></td>
                <td><?php echo $row['cargo']?></td>
                <td><?php echo date('h:i A', strtotime($row['hora_llegada'])).$status?></td>
                <td><?php 
                if($row['hora_salida'] != null)
                { 
                    echo date('h:i A', strtotime($row['hora_salida']));
                }else{
                    echo '00:00 PM';
                }
                ?></td>
                <td><?php 
                if($row['horas_laboradas'] != null)
                {
                    echo number_format($row['horas_laboradas'],1);
                }else{
                    $hora_llegada = new DateTime($row['hora_llegada']);
                    $hora = date('H:i:s');
                    $hora_actual = new DateTime($hora);
                    $interval = $hora_actual->diff($hora_llegada);
                    $hrs = $interval->format('%h');
                    $mins = $interval->format('%i');
                    $mins = $mins/60;
                    $int = $hrs + $mins;
                    echo number_format($int, 1);
                }
                ?></td>
                </tr>
                <?php } ?>
		</tbody>
		</table>