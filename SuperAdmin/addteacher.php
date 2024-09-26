<?php 
  
include 'includes/session.php';
include_once('includes/connect_database.php');

$client_lang['100'] = '<div class="alert alert-warning text-center"><font size="3">Please fill All fileds.</font></div><br>';
$client_lang['101'] = '<div class="alert alert-success text-center"><font size="3">Success Added.</font></div><br>';
$client_lang['102'] = '<div class="alert alert-danger text-center"><font size="3">Something went wrong.</font></div><br>';
$client_lang['103'] = '<div class="alert alert-danger text-center"><font size="3">Teacher already exist.</font></div><br>';

if(isset($_POST['submit'])){
	echo '<script>alert("already")</script>';
	$namev            = mysqli_escape_string($connect, $_POST['namev']);
  	$emailv           = mysqli_escape_string($connect, $_POST['emailv']);
  	$phonev           = mysqli_escape_string($connect, $_POST['phonev']);
  	$created          = date('d/m/Y H:i:sA');

  	$check            = mysqli_query($connect, "SELECT * FROM teachers WHERE email='$emailv' AND phone='$phonev' ");

  	if ($namev=='' OR $emailv=='' OR $phonev=='') {
  		$_SESSION['msg']="100";
  		
  		header("Location: addteacher.php");
        exit;
    }else{

     	if (mysqli_num_rows($check) == 0) {

     	  $insert = "INSERT INTO `teachers` (`name`, `phone`, `email`, `created`) VALUES ('$namev', '$phonev', '$emailv', '$created')";

          $run = mysqli_query($connect, $insert);

	        if ($run) {

	          	$_SESSION['msg']="101";
	            header("Location: addteacher.php");
	            exit;
	          
	        }else{

	            $_SESSION['msg']="102";
	            header("Location: addteacher.php");
	            exit;
	          
	        }
        }else{

          $_SESSION['msg']="103";
          header("Location: addteacher.php");
          exit;
        
        }
	}
}
  
?>

<!DOCTYPE html>
<html lang="en" class="perfect-scrollbar-on">

<head>
  <?php include 'meta.php'; ?>
</head>

<body> <!-- class="sidebar-mini" -->
  <div class="wrapper">

    <!-- Side Nav -->
    <?php include 'side_nav.php'; ?>

    <div class="main-panel">

      <!-- Navbar -->
      <?php include 'top_right_nav.php'; ?>
      <div class="content">
      	
      	<div class="container_fluid">

      		<div class="col-md-12 offset-md-2 mr-auto ml-auto">
	           	<?php if(isset($_SESSION['msg'])){?>
	            	<?php echo $client_lang[$_SESSION['msg']] ; ?>
	           	<?php unset($_SESSION['msg']);}?>
	        </div>

      		<div class="row">
      			<div class="col-lg-3 col-md-2 col-sm-12"></div>
      			<div class="col-lg-7 col-md-8 col-sm-12">
	              <form method="POST" action="addteacher.php">
	                <div class="card ">
	                  <div class="card-header card-header-rose card-header-icon">
	                    <div class="card-icon">
	                      <i class="material-icons">assignment_ind</i>
	                    </div>
	                    <h4 class="card-title">Add Teacher</h4>
	                  </div>
	                  <div class="card-body ">
	                    
	                    <div class="row">
	                    	
								<div class="input-group form-control-lg">
									<div class="input-group-prepend">
									   <span class="input-group-text">
									   <i class="material-icons">face</i>
									   </span>
									</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group bmd-form-group is-filled">
									   <label for="namev" class="bmd-label-floating">Name of Whom Visiting*</label>
									   <input type="text" class="form-control" id="namev" name="namev" required aria-required="true" autocomplete="off">
									</div>
								</div>
							</div>
							
								<div class="input-group form-control-lg">
									<div class="input-group-prepend">
									   <span class="input-group-text">
									   <i class="material-icons">email</i>
									   </span>
									</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group bmd-form-group is-filled">
									   <label for="emailv" class="bmd-label-floating">Email of Whom Visiting*</label>
									   <input type="email" class="form-control" id="emailv" name="emailv" required aria-required="true" autocomplete="off">
									</div>
								</div>
							</div>
							
								<div class="input-group form-control-lg">
									<div class="input-group-prepend">
									   <span class="input-group-text">
									   <i class="material-icons">contact_phone</i>
									   </span>
									</div>
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="form-group bmd-form-group is-filled">
									   <label for="phonev" class="bmd-label-floating">Number of Whom Visiting*</label>
									   <input type="number" class="form-control" id="phonev" name="phonev" required aria-required="true" autocomplete="off">
									</div>
								</div>
							</div>
	                    </div>
	                    	
	                  </div>
	                  <div class="card-footer ml-auto mr-auto">
	                    <button type="submit" name="submit" class="btn btn-rose">Save</button>
	                  </div>
	                </div>
	              </form>
	            </div>
      		</div>

      		<div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">supervised_user_circle</i>
                  </div>
                  <h4 class="card-title">Registered Teachers</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!-- Here you can write extra buttons/actions for the toolbar -->
                  </div>
                  <br>
                  <div class="material-datatables">
 
                    <table id="datatables1" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%;">
                        <thead>
                            <tr> 
                                <th width="5%">Sr No</th>
                                <th width="10%">Name</th>
                                <th width="10%">Phone</th>
                                <th width="10%">Email</th>
                                <th width="15%">Creadted </th>
                                <th width="5%" class="disabled-sorting text-right">Delete</th>
                            </tr>
                        </thead>
                      <tbody id="appen_teacher_data">
                      </tbody>
                    </table>

                  </div>
                </div>
                <!-- end content-->
              </div>
              <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
          </div>
          <!-- end row -->

      	</div>

      </div>

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