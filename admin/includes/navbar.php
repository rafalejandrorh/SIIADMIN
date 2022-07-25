<header class="main-header">
    <a href="../home/index.php" class="logo">
      <span class="logo-mini"><b>AN</b></span>
      <span class="logo-lg"><b>Asistencia y Nómina</b></span>
    </a>
    <nav class="navbar navbar-static-top" style="background-color:#222d32;">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
          
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo (!empty($user['photo'])) ? '../../images/'.$user['photo'] : '../../images/profile.jpg'; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $user['firstname'].' '.$user['lastname']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="<?php echo (!empty($user['photo'])) ? '../../images/'.$user['photo'] : '../../images/profile.jpg'; ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $user['firstname'].' '.$user['lastname']; ?>
                  <small>Miembro desde <?php echo date('M. Y', strtotime($user['created_on'])); ?></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#profile" data-toggle="modal" class="btn btn-default btn-flat" id="admin_profile">Actualizar</a>
                </div>
                <div class="pull-right">
                  <a href="../../controllers/sesion/logout.php" class="btn btn-default btn-flat">Cerrar Sesión</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <?php include 'profile_modal.php'; ?>