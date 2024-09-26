<?php 
  
  include 'includes/session.php';
  include 'includes/connect_database.php';
  
?>

<!DOCTYPE html>
<html lang="en" class="perfect-scrollbar-on">

<head>
  <?php include 'meta.php'; ?>
</head>

<body> <!-- class="sidebar-mini" -->
  <div class="wrapper ">

    <!-- Side Nav -->
    <?php include 'side_nav.php'; ?>

    <div class="main-panel">

      <!-- Navbar -->
      <?php include "top_right_nav.php"; ?>
      <!-- End Navbar -->

      <div class="content">
        <div class="container-fluid">
          <!-- your content here -->
        
          
          <div class="row">
            <div class="col-md-8">

              <?php echo isset($error['success']) ? $error['success'] : '';?>
              <?php echo isset($error['error']) ? $error['error'] : '';?>
              <?php echo isset($error['empty']) ? $error['empty'] : '';?>
              <br>

              <div class="card">
                <div class="card-header card-header-info text-center">
                  <h4 class="card-title">Update System Info</h4>
                </div>
                <br>
                <form id="updateSystem" method="post" enctype="multipart/form-data" >

                <div class="card-body">
                    
                    <div class="row">
                      <div class="col-md-4 offset-md-4">
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                          <div class="fileinput-new thumbnail img-circle">
                            <img src="media/org_logo.png" alt="Organization's Logo">
                          </div>
                          <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                          <div class="form-group">
                            <span class="btn btn-round btn-rose btn-file">
                              <span class="fileinput-new">Update Logo</span>
                              <span class="fileinput-exists">Change</span>
                              <input type="file" name="profile" id="profile" accept="image/*">
                            </span>
                            <br>
                            <a href="#pablo" id="pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                            <p class="text-info">Image less than 2MB <br>(Make sure it is a transparent image)</p>
                            <p></p>
                          </div>
                        </div>
                      </div>
                    </div>

                    <?php 
                      $getinfo    = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM inorg WHERE id='1' "));
                      $name       = $getinfo['name'];
                      $Phone      = $getinfo['phone'];
                      $email      = $getinfo['email'];
                      $website    = $getinfo['website'];
                      $year       = $getinfo['year'];
                    ?>

                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label for="name" class="bmd-label-floating">Organization Name:*</label>
                          <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>" aria-required="true" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label for="phone" class="bmd-label-floating">Phone:*</label>
                          <input type="number" class="form-control" id="phone" name="phone" value="<?php echo $Phone ?>" aria-required="true" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group bmd-form-group">
                          <label for="email" class="bmd-label-floating">Email:*</label>
                          <input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>" aria-required="true" required>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label for="website" class="bmd-label-floating">Website:*</label>
                          <input type="text" class="form-control" id="website" name="website" value="<?php echo $website ?>" aria-required="true" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label for="year" class="bmd-label-floating">Active Year:*</label>
                          <input type="number" class="form-control" id="year" name="year" value="<?php echo $year ?>" aria-required="true" required>
                        </div>
                      </div>
                    </div>

                </div>

                <div class="card-footer text-right">
                    <div class="form-check mr-auto">
                      <label class="form-check-label"></label>
                    </div>
                    <button class="text-white btn btn-rose" type="submit" name="submit">Submit</button>
                </div>

                </form>

              </div>
            </div>

            <div class="col-md-4">

              <?php echo isset($error['success']) ? $error['success'] : '';?>
              <?php echo isset($error['error']) ? $error['error'] : '';?>
              <?php echo isset($error['empty']) ? $error['empty'] : '';?>
              <br>

              <div class="card">
                <div class="card-header card-header-info text-center">
                  <h4 class="card-title">Update Email & Password</h4>
                </div>
                <br>
                <form method="post" id="settings_form">
                
                <?php 
                  $run    = mysqli_fetch_array(mysqli_query($db, "SELECT email FROM administrator WHERE id='1' "));
                  $email  = $run['email'];
                ?>
                <div class="card-body ">
                    <div class="form-group">
                      <label for="upemail">Email</label>
                      <input type="email" class="form-control" id="upemail" name="upemail" value="<?php echo $email; ?>" required>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="form-group">
                      <label for="old_password">Old Password</label>
                      <input type="password" class="form-control" id="old_password" name="old_password" minlength="6" required>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="form-group">
                      <label for="new_password">New Password</label>
                      <input type="password" class="form-control" id="new_password" name="new_password" minlength="6" required>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="form-group">
                      <label for="confirm_password">Confirm New Password</label>
                      <input type="password" class="form-control" equalTo="#new_password" id="confirm_password" name="confirm_password" minlength="6" required>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <div class="form-check mr-auto">
                      <label class="form-check-label"></label>
                    </div>
                    <button class="text-white btn btn-rose" type="submit" name="pwdsubmit" >Submit</button>
                </div>

                </form>

              </div>
            </div>

          </div>

        </div>
      </div>

      <!-- Footer -->
      <?php include 'footer.php'; ?>

    </div>
  </div>
</body>

  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="assets/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="assets/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="assets/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="assets/js/plugins/arrive.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>

  <script src="assets/demo/common.js"></script>

  <?php include 'includes/common_modals.php'; ?>
  
</html>