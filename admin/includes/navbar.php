<header class="main-header">
    <a href="../home/administracion.php" class="logo">
      <span class="logo-mini"><b>SIIAD</b></span>
      <span class="logo-lg"><b>SIIADMIN</b></span>
    </a>
    <nav class="navbar navbar-static-top" style="background-color:#222d32;">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
          
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo (!empty($_SESSION['foto'])) ? '../../images/perfil/'.$_SESSION['foto'] : '../../images/perfil/profile.jpg'; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['nombres'].' '.$_SESSION['apellidos']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="<?php echo (!empty($_SESSION['foto'])) ? '../../images/perfil/'.$_SESSION['foto'] : '../../images/perfil/profile.jpg'; ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION['nombres'].' '.$_SESSION['apellidos']; ?>
                  <small>Miembro desde <?php echo date('M. Y', strtotime($_SESSION['ingreso'])); ?></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#profile" data-toggle="modal" class="btn btn-default btn-flat" id="admin_profile"><i class="fa fa-refresh"></i> Actualizar</a>
                </div>
                <div class="pull-right">
                  <a href="../../controllers/sesion/logout.php" class="btn btn-default btn-flat"><i class="fa fa-power-off"></i> Cerrar Sesión</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
              <i class="fas fa-th-large"></i>
            </a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>
  
  <?php include 'profile_modal.php'; ?>