<?php

  ob_start(); 
  session_start();

  // start session
  //include 'includes/session.php';

  include_once('includes/connect_database.php');
  
  // if user click Login button
  if(isset($_POST['login'])){
  
    // get username and password
    $username = $_POST['username'];
    $username = mysqli_real_escape_string($db, $username);

    $password = $_POST['password'];
    $password = mysqli_real_escape_string($db, $password);
    
    // set time for session timeout
    $currentTime = time() + 25200;
    $expired = 5600;
    
    // create array variable to handle error
    $error = array();
    
    // check whether $username is empty or not
    if(empty($username)){
      $error['username'] = '<span class="badge badge-pill badge-danger"> Email should be filled </span>';
    }

    if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
  	  $error['email'] = '<span class="badge badge-pill badge-danger"> Invalid email format </span>';
  	}
    
    // check whether $password is empty or not
    if(empty($password)){
      $error['password'] = '<span class="badge badge-pill badge-danger"> Password should be filled </span>';
    }
    
    // if username and password is not empty, check in database
    if(!empty($username) && !empty($password)){
      
      // change username to lowercase
      //$username = md5($username);
      
      //encript password to md5
      $password = md5($password);
      
      // get data from user table
      $sql_query = "SELECT * FROM administrator WHERE email = ? AND password = ? ";
            
      $stmt = $db->stmt_init();
      if($stmt->prepare($sql_query)) {
        // Bind your variables to replace the ?s
        $stmt->bind_param('ss', $username, $password);
        // Execute query
        $stmt->execute();
        /* store result */
        $stmt->store_result();
        $num = $stmt->num_rows;
        // Close statement object
        $stmt->close();
        if($num == 1){
          $_SESSION['admin_session'] = $username;
          $_SESSION['timeout'] = $currentTime + $expired;
          header("location: index.php");
        }else{
          $error['failed'] = '<span class="badge badge-pill badge-danger"> Login Failed </span>';
        }
      }
      
    } 
  }
  
  // if session not set go to login page
  if(isset($_SESSION['admin_session'])){
    header("location:index.php");
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'meta.php'; ?>
</head>

<body class="off-canvas-sidebar">

  <!-- Navbar -->
  <?php include 'lr_nav.php'; ?>
  <!-- End Navbar -->

  <div class="wrapper wrapper-full-page">
    <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('assets/img/login.jpg'); background-size: cover; background-position: top center;">
      <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
            <form class="form" method="POST">
              <div class="card card-login">
                <div class="card-header card-header-rose text-center">
                  <h4 class="card-title">Login</h4>
                </div>
                <div class="card-body ">
                  <p class="card-description text-center">Welcome Back!</p>
                  <h5 style="color: red;"><center><?php echo isset($error['failed']) ? $error['failed'] : '';?></center></h5>
                  <span class="bmd-form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">email</i>
                        </span>
                      </div>
                      <input type="email" class="form-control" placeholder="Email..." name="username" required>
                    </div>
                  </span>
                  <span class="bmd-form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">lock_outline</i>
                        </span>
                      </div>
                      <input type="password" class="form-control" placeholder="Password..." name="password" required>
                    </div>
                  </span>
                </div>
                <div class="card-footer justify-content-center">
                  <button type="submit" name="login" class="btn btn-rose btn-md mt-4">Lets Go</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      
      <!-- Footer -->
      <?php include 'lr_footer.php'; ?>
      <!-- Enf Footer -->

    </div>
  </div>
  
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Chartist JS -->
  <script src="assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=2.1.1" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
</body>

</html>