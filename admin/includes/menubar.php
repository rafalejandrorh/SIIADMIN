<aside class="main-sidebar" style="background-color:#222d32;">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo (!empty($user['photo'])) ? '../../images/'.$user['photo'] : '../../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
          <a><i class="fa fa-circle text-success"></i> En Línea</a>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">

        <li class="header">REPORTES</li>
        <li class=""><a href="../home/index.php"><i class="fa fa-dashboard"></i> <span>Panel de Control</span></a></li>
        
        <li class="header">ADMINISTRACIÓN</li>
        <li><a href="../asistencia/index.php"><i class="fa fa-calendar"></i> <span>Asistencia</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Empleados</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../empleados/index.php"><i class="fa fa-circle-o"></i> Lista de Empleados</a></li>
            <li><a href="../horarios/index.php"><i class="fa fa-circle-o"></i> Horarios</a></li>
            <li><a href="../tiempoextra/index.php"><i class="fa fa-circle-o"></i> Tiempo Extra</a></li>
            <li><a href="../avancefectivo/index.php"><i class="fa fa-circle-o"></i> Avance Efectivo</a></li>
          </ul>
        </li>
        <li><a href="../tasadolar/index.php"><i class="fa fa-files-o"></i> <span>Tasa del Dolar</span></a></li>
        <li><a href="../cargos/index.php"><i class="fa fa-suitcase"></i> <span>Cargos</span></a></li>
        <li><a href="../deducciones/index.php"><i class="fa fa-file-text"></i> <span>Deducciones</span></a></li>
        <li><a href="../nomina/index.php"><i class="fa fa-money"></i> <span>Nómina</span></a></li>
    </section>
  </aside>