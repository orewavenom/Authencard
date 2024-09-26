<?php 
  
  include 'includes/session.php';

  
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
        
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">supervised_user_circle</i>
                  </div>
                  <h4 class="card-title">Bulk Registration Student</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!-- Here you can write extra buttons/actions for the toolbar -->
                  </div>

                  <div class="alert alert-success"><i class="fa fa-info-circle" style="color: white;"></i> &nbsp;Ensure that the file upload is in CSV Format Otherwise it will not save</div>

                  <div class="alert alert-info">
                          <h4><i class="fa fa-info-circle" style="color: white;"></i> &nbsp;Steps to save the file!</h4>
                          <div class="container">
                              <ol>
                                  <li>Download the sample file format below on the mail icon or on top of the to the right corner of this page on a downoad icon</li>
                                  <li>Fill the employee details in the columns of the file</li>
                                  <li>Save the file as CSV not as xls</li>
                                  <li>Upload the file</li>
                              </ol>
                          </div>
                          SAMPLE FORMAT &nbsp; <a style="color: black;" href="bulk_register.php?ids=1"><i class="fa fa-envelope" style="color: black;"></i> Download Sample</a> &nbsp; Note:The web as file type will only be noted on excel files download from this application
                  </div>

                  <hr>

                  <form method="post" action="includes/upload.php" enctype="multipart/form-data">
                      <h5>Select CSV File</h5>
                      <input name="file" type="file" id="file" accept=".xlsx, .xls, .csv" required />
                      <button class="btn btn-success" name="bulk_reg" id="bulk_reg">
                        <span class="material-icons">publish</span> &nbsp;Import
                      </button>
                  </form>

                  <?php

                    if (isset($_GET['status'])) {

                      $getStatus = $_GET['status'];

                      if ($getStatus=='ok') {

                  ?>

                  <div class="alert alert-success">
                    <i class="fa fa-info-circle"></i>
                    Successfully Registered!
                  </div>

                  <?php  }else if ($getStatus=='no') { ?>

                  <div class="alert alert-danger">
                    <i class="fa fa-info-circle"></i>
                    Failed to register, Something went wrong!
                  </div>
                       
                  <?php } } ?>

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
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
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