<aside class="main-sidebar" style="background-color:#222d32;">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo (!empty($user['photo'])) ? 'http://localhost/Sistema-MVC/images/'.$user['photo'] : 'http://localhost/Sistema-MVC/images/profile.jpg'; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
          <a><i class="fa fa-circle text-success"></i> En Línea</a>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">

        <li class="header">REPORTES</li>
        <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Panel de Control</span></a></li>
        
        <li class="header">ADMINISTRACIÓN</li>
        <li><a href="asistencia.php"><i class="fa fa-calendar"></i> <span>Asistencia</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Empleados</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="empleados.php"><i class="fa fa-circle-o"></i> Lista de Empleados</a></li>
            <li><a href="horarios.php"><i class="fa fa-circle-o"></i> Horarios</a></li>
            <li><a href="tiempoextra.php"><i class="fa fa-circle-o"></i> Tiempo Extra</a></li>
            <li><a href="avancefectivo.php"><i class="fa fa-circle-o"></i> Avance Efectivo</a></li>
          </ul>
        </li>
        <li><a href="tasa_dolar.php"><i class="fa fa-files-o"></i> <span>Tasa del Dolar</span></a></li>
        <li><a href="cargos.php"><i class="fa fa-suitcase"></i> <span>Cargos</span></a></li>
        <li><a href="deducciones.php"><i class="fa fa-file-text"></i> <span>Deducciones</span></a></li>
        
        <li class="header">IMPRESIÓN</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>PDF</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
        <li><a href="asistencia_employee.php"><i class="fa fa-files-o"></i> <span>Asistencia</span></a></li>
        <li><a href="horarios_employee.php"><i class="fa fa-files-o"></i> <span>Empleados</span></a></li>
        <li><a href="nomina.php"><i class="fa fa-files-o"></i> <span>Nómina</span></a></li>

      </ul>
</li>
    </section>
  </aside>