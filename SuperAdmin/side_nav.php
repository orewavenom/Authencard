	<?php $pagename = basename($_SERVER['PHP_SELF']); ?>

  <div class="sidebar" data-color="azure" data-background-color="black" data-image="assets/img/sidebar-1.jpg">
        <div class="logo" align="center">
          <a href="index.php" class="simple-text logo-mini">
            <img src="assets/img/angular2-logo-white.png" width="100%">
          </a>
          <a href="index.php" class="simple-text logo-normal">
            eCard Generator
          </a>
          <hr>
          <img id="system_logo" src="media/org_logo.png" width="35%">
        </div>
        <div class="sidebar-wrapper">
          <ul class="nav">

            <li class="nav-item <?php if ($pagename == 'index.php') {echo 'active';} ?> ">
              <a class="nav-link" href="index.php">
                <i class="material-icons">dashboard</i>
                <p>Dashboard</p>
              </a>
            </li>

            <li class="nav-item <?php if ($pagename == 'addusers.php') {echo 'active';} ?>">
              <a class="nav-link" href='addusers.php'>
                <i class="material-icons">supervised_user_circle</i>
                <p>Add Visitor</p>
              </a>
            </li>

            <li class="nav-item <?php if ($pagename == 'addteacher.php') {echo 'active';} ?>">
              <a class="nav-link" href='addteacher.php'>
                <i class="material-icons">assignment_ind</i>
                <p>Add Teacher</p>
              </a>
            </li>
            
            <li class="nav-item <?php if ($pagename == 'settings.php') {echo 'active';} ?>">
              <a class="nav-link" href="settings.php">
                <i class="material-icons">settings</i>
                <p>Profile (Settings)</p>
              </a>
            </li>

            <li class="nav-item active-pro ">
              <a class="nav-link" href="javascript:;" onclick="demo.showSwal('logout')">
                <i class="material-icons">logout</i>
                <p>Logout</p>
              </a>
            </li>

          </ul>
        </div>

        <!-- <div class="sidebar-background" style="background-image: url('assets/img/sidebar-1.jpg') "/> -->
        
    </div>