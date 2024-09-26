<?php 
  
include 'includes/session.php';
  
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
      <!-- End Navbar -->
        
        
        
      <div class="content">
        <div class="container-fluid">

          <!-- your content here -->

           <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">supervised_user_circle</i>
                  </div>
                  <h4 class="card-title">Registered Visitors</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!-- Here you can write extra buttons/actions for the toolbar -->
                  </div>
                  <br>
                  <div class="material-datatables">
 
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%;">
                        <thead>
                            <tr> 
                                <th width="5%">Sr No</th>
                                <th width="10%">Name</th>
                                <th width="10%">Phone</th>
                                <th width="10%">Email</th>
                                <th width="12%">Name *(Whome Visiting)</th>
                                <th width="10%">Phone *(Whome Visiting)</th>
                                <th width="15%">Email *(Whome Visiting)</th>
                                <th width="6%">Expiry </th>
                                <th width="6%">Creadted </th>
                                <th width="5%" class="disabled-sorting text-right">Print::Delete</th>
                            </tr>
                        </thead>
                      <tbody id="appen_users_data">
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