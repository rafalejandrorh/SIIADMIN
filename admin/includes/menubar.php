<aside class="main-sidebar" style="background-color:#222d32;">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo (!empty($_SESSION['foto'])) ? '../../images/perfil/'.$_SESSION['foto'] : '../../images/perfil/profile.jpg'; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['nombres'].' '.$_SESSION['apellidos']; ?></p>
          <a><i class="fa fa-circle text-success"></i> En Línea</a>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">

        <li class="header">REPORTES GRÁFICOS</li>
        <li class=""><a href="../home/index.php"><i class="fa fa-dashboard"></i> <span>Administración</span></a></li>
        <li class=""><a href="#"><i class="fa fa-line-chart"></i> <span>Finanzas</span></a></li>
        <li class=""><a href="#"><i class="fa fa-lock"></i> <span>Seguridad</span></a></li>
        
        <li class="header">ADMINISTRACIÓN</li>
        <li><a href="../asistencia/index.php"><i class="fa fa-calendar"></i> <span>Asistencia</span></a></li>
        <li><a href="../empleados/index.php"><i class="fa fa-users"></i> <span>Empleados</span></a></li>
        <li><a href="#"><i class="fa fa-credit-card"></i> <span>Métodos de Pago</span></a></li>
        <li><a href="../horarios/index.php"><i class="fa fa-clock-o"></i> <span>Horarios</span></a></li>
        <li><a href="../cargos/index.php"><i class="fa fa-suitcase"></i> <span>Cargos</span></a></li>

        <li class="header">FINANZAS</li>
        <li><a href="../nomina/index.php"><i class="fa fa-calculator"></i> <span>Cálculo de Nómina</span></a></li>
        <li><a href="../nomina/index.php"><i class="fa fa-bank"></i> <span>Histórico de Nómina</span></a></li>
        <li><a href="../deducciones/index.php"><i class="fa fa-percent"></i> <span>Deducciones</span></a></li>
        <li><a href="../tasadolar/index.php"><i class="fa fa-dollar"></i> <span>Tasa del Dolar</span></a></li>
        <li><a href="../tiempoextra/index.php"><i class="fa fa-hourglass-1"></i> <span>Tiempo Extra</span></a></li>
        <li><a href="../avancefectivo/index.php"><i class="fa fa-money"></i> <span>Avance de Efectivo</span></a></li>

        <li class="header">SEGURIDAD</li>
        <li><a href="#"><i class="fa fa-user"></i> <span>Usuarios del Sistema</span></a></li>
        <li><a href="../sesion/index.php"><i class="fa fa-history"></i> <span>Historial de Sesión</span></a></li>
        <li><a href="../trazas/index.php"><i class="fa fa-save"></i> <span>Trazas</span></a></li>
      </ul>  
    </section>
  </aside>


  <!-- <li class="treeview">
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
          </ul>
   </li> -->