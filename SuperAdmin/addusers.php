<?php


use PHPMailer\PHPMailer\PHPMailer;
require 'mailer/autoload.php';
require_once 'vendor_sms/autoload.php';

include 'includes/session.php';

date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)

include_once('includes/connect_database.php');


$client_lang['100'] = '<div class="alert alert-warning text-center"><font size="3">Please fill all fileds.</font></div><br>';
$client_lang['101'] = '<div class="alert alert-success text-center"><font size="3">Success Generated.</font></div><br>';
$client_lang['102'] = '<div class="alert alert-danger text-center"><font size="3">Something went wrong.</font></div><br>';
$client_lang['103'] = '<div class="alert alert-danger text-center"><font size="3">Email/Phone already exist.</font></div><br>';

   if(isset($_POST['submit'])){

      function generateRandomString($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
      }

      $name             = mysqli_escape_string($connect, $_POST['name']);
      $email            = mysqli_escape_string($connect, $_POST['email']);
      $phone            = mysqli_escape_string($connect, $_POST['phone']);
      $namev            = mysqli_escape_string($connect, $_POST['namev']);
      $emailv           = mysqli_escape_string($connect, $_POST['emailv']);
      $phonev           = mysqli_escape_string($connect, $_POST['phonev']);
      $datetime         = mysqli_escape_string($connect, $_POST['expiry']);
      $seo_url          = generateRandomString();
      $created          = date('d/m/Y H:i:sA');

      $check            = mysqli_query($connect, "SELECT * FROM visitors WHERE (email='$email' OR phone='$phone') AND status='1' ");

      $img              = $_SESSION['imgbase64'];
      $imageName        = generateRandomString().'.png';
      $path             = "images/uploads/".$imageName;

      if ($name=='' OR $email=='' OR $phone=='' OR $namev=='' OR $emailv=='' OR $phonev=='') {
        $_SESSION['msg']="100";
        header("Location: addusers.php");
        exit;
      }else{

        if (mysqli_num_rows($check) == 0) {

          
          //SMS From TextLocal.in
          /*$apiKey = urlencode('Mzg2YjE1MzMwN2UxYmY0YzE0NjMwM2RmMDFhMmJjNmI=');
          $numbers = array('91'.$phonev);
          $sender = urlencode('TXTLCL');
          $message = rawurlencode('Hello '.$namev.' it\'s a reminder for you, '.$name.' will be coming to meet you');
          $numbers = implode(',', $numbers);
          $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
          $ch = curl_init('https://api.textlocal.in/send/');
          curl_setopt($ch, CURLOPT_POST, true);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($ch);
          curl_close($ch);*/


          // SMS From MessageBird
          $messagebird = new MessageBird\Client('API_KEY');
          $message = new MessageBird\Objects\Message;
          $message->originator = '+91'.$phonev;
          $message->recipients = ['+91'.$phonev];
          $message->body = 'Hello '.$namev.' it\'s a reminder for you, '.$name.' will be coming to meet you';
          $response = $messagebird->messages->create($message);

          $upload = file_put_contents($path, base64_decode($img));

          $insert = "INSERT INTO visitors (name, email, phone, namev, emailv, phonev, profile, expiry, seo_url, status, created) VALUES ('$name', '$email', '$phone', '$namev', '$emailv', '$phonev', '$imageName', '$datetime', '$seo_url', '1', '$created')";
          $run = mysqli_query($connect, $insert);

          if ($run && $upload) {

            $mail = new PHPMailer;
            $mail->setLanguage("en");
            $mail->isSMTP();
            $mail->SMTPDebug = 2;
            $mail->Host = 'smtp.hostinger.in';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->Username = 'EMAIL';
            $mail->Password = 'PASSWORD';
            $mail->setFrom('EMAIL', 'NAME');
            $mail->addReplyTo('EMAIL', 'NAME');
            $mail->addAddress($email, 'Visitors ID - Vidyalankar Polytechnic | Mumbai');
            $mail->Subject = 'eCard - Visitors ID';
            $mail->AltBody = 'Please click The following link to get your digital visiting card using your phone number www.abc.com';
            $mail->send();

            /*$to = $email;
            $msg = "Hello ".$name." Your visitor Card has been genrated.";
            $subject ="Digital Visitor Card";
            $headers .= "MIME-Version: 1.0"."\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
            $headers .= 'From:Vidyalankar Polytechnic | Mumbai <info@sakec.ac.in>'."\r\n";
            $ms.="<html></body><div><div>Dear $name,</div></br></br>";
            $ms.="<div style='padding-top:8px;'>Please click The following link to get your digital visiting card.</div>
            <div style='padding-top:10px;'><a href='http://localhost/php/TempCard/ecard/$phone'>Click Here</a></div>
            </div>
            </body></html>";
            mail($to, $subject, $ms, $headers);*/

            unset($_SESSION['imgbase64']);
            $_SESSION['msg']="101";
            header("Location: addusers.php");
            exit;

          }else{
            $_SESSION['msg']="102";
            header("Location: addusers.php");
            exit;
          }

        }else{
          $_SESSION['msg']="103";
          header("Location: addusers.php");
          exit;
        }

      }
              
   }


?>
<!DOCTYPE html>
<html lang="en" class="perfect-scrollbar-on">
   <head>
      <?php include 'meta.php'; ?>
      <style>
         #x {
         position: absolute;
         background: red;
         color: white;
         top: -20px;
         right: -15px;
         z-index: 1;
         }
         #xx {
         position: absolute;
         background: red;
         color: white;
         top: -20px;
         right: -8px;
         z-index: 1;
         }

         video{
            background-color: #666;
         }

         /*.captured{
            display: none;
         }*/
      </style>
   </head>
   <body>
      <!-- class="sidebar-mini" -->
      <div class="wrapper">
         <!-- Side Nav -->
         <?php include 'side_nav.php'; ?>

         <div class="main-panel">
            <!-- Navbar -->
            <?php include 'top_right_nav.php'; ?>
            <!-- End Navbar -->
            <div class="content">
               <div class="container-fluid">
                  
                  <div class="col-md-12 offset-md-2 mr-auto ml-auto">
                   <?php if(isset($_SESSION['msg'])){?>
                     <?php echo $client_lang[$_SESSION['msg']] ; ?>
                   <?php unset($_SESSION['msg']);}?>
                 </div>

                  <div class="col-md-8 col-12 mr-auto ml-auto">
                    <div class="wizard-container" id="update_profile_info">
                        <div class="card card-wizard active" data-color="rose" id="wizardProfile">
                           <form method="POST" action="addusers.php">
                              <div class="card-header text-center mt-3">
                                 <h3 class="card-title">
                                    Add New Visitor
                                 </h3>
                                 <h5 class="card-description">This information will be used as your id card details</h5>
                              </div>
                              <div class="wizard-navigation">
                                 <ul class="nav nav-pills">
                                    <li class="nav-item" style="width: 33.3333%;">
                                       <a class="nav-link active" href="#about" data-toggle="tab" role="tab" id="about_tab">
                                       About
                                       </a>
                                    </li>
                                    <li class="nav-item" style="width: 33.3333%;">
                                       <a class="nav-link " href="#snap" data-toggle="tab" role="tab" id="account_tab">
                                       Picture
                                       </a>
                                    </li>
                                    <li class="nav-item" style="width: 33.3333%;">
                                       <a class="nav-link " href="#preview" data-toggle="tab" role="tab" id="address_tab">
                                       Preview
                                       </a>
                                    </li>
                                 </ul>
                                 <div class="moving-tab">
                                    About
                                 </div>
                              </div>
                              <div class="card-body">
                                 <div class="tab-content">
                                    <div class="tab-pane active" id="about">
                                       <h5 class="info-text"> Let's start with the basic information</h5>
                                       <div class="row justify-content-center">
                                          <div class="col-md-6 col-sm-12">
                                             <div class="input-group form-control-lg">
                                                <div class="input-group-prepend">
                                                   <span class="input-group-text">
                                                   <i class="material-icons">face</i>
                                                   </span>
                                                </div>
                                                <div class="form-group bmd-form-group is-filled">
                                                   <label for="name" class="bmd-label-floating">Name (required)</label>
                                                   <input type="text" class="form-control" id="name" name="name" required aria-required="true" autocomplete="off">
                                                </div>
                                             </div>
                                             <div class="input-group form-control-lg">
                                                <div class="input-group-prepend">
                                                   <span class="input-group-text">
                                                   <i class="material-icons">email</i>
                                                   </span>
                                                </div>
                                                <div class="form-group bmd-form-group is-filled">
                                                   <label for="email" class="bmd-label-floating">Email (required)</label>
                                                   <input type="email" class="form-control" id="email" name="email" required aria-required="true" autocomplete="off">
                                                </div>
                                             </div>
                                             <div class="input-group form-control-lg">
                                                <div class="input-group-prepend">
                                                   <span class="input-group-text">
                                                   <i class="material-icons">contact_phone</i>
                                                   </span>
                                                </div>
                                                <div class="form-group bmd-form-group is-filled">
                                                   <label for="phone" class="bmd-label-floating">Phone Number (required)</label>
                                                   <input type="number" class="form-control" id="phone" name="phone" required aria-required="true" autocomplete="off">
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-6 col-sm-12">
                                             <div class="input-group form-control-lg">
                                                <div class="input-group-prepend">
                                                   <span class="input-group-text">
                                                   <i class="material-icons">face</i>
                                                   </span>
                                                </div>
                                                <div class="form-group bmd-form-group is-filled">
                                                   <label for="phonev" class="bmd-label-floating">Select Teacher</label>
                                                   <select class="selectpicker" data-live-search="true" data-style="btn btn-rose" title="Select Teacher" name="namev" id="select_teacher">
                                                    <option disabled>Select Fees Type</option>
                                                    <?php

                                                        $query_ft       = mysqli_query($connect, "SELECT * FROM `teachers`");
                                                        while($query_row_ft   = mysqli_fetch_assoc($query_ft)){
                                                           $ft = $query_row_ft['name'];
                                                           $ft_email = $query_row_ft['email'];
                                                           $ft_phone = $query_row_ft['name'];
                                                           $ftid = $query_row_ft['id'];
                                                    ?>
                                                    <option value="<?php echo $ftid; ?>" id="teacher_name"><?php echo $ft; ?></option>
                                                    <?php } ?>    
                                                   </select>
                                                </div>
                                             </div>
                                             <div class="input-group form-control-lg">
                                                <div class="input-group-prepend">
                                                   <span class="input-group-text">
                                                   <i class="material-icons">email</i>
                                                   </span>
                                                </div>
                                                <div class="form-group bmd-form-group emailv_input">
                                                   <label for="emailv" class="control-label">Email of Whom Visiting*</label>
                                                   <input type="email" class="form-control" id="emailv" name="emailv" readonly>
                                                </div>
                                             </div>
                                             <div class="input-group form-control-lg">
                                                <div class="input-group-prepend">
                                                   <span class="input-group-text">
                                                   <i class="material-icons">contact_phone</i>
                                                   </span>
                                                </div>
                                                <div class="form-group bmd-form-group namev_input">
                                                   <label for="phonev" class="control-label">Number of Whom Visiting*</label>
                                                   <input type="number" class="form-control" id="phonev" name="phonev" readonly>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-12 col-lg-12 col-sm-12">
                                             <div class="input-group form-control-lg">
                                                <div class="input-group-prepend">
                                                   <span class="input-group-text">
                                                   <i class="material-icons">edit_calendar</i>
                                                   </span>
                                                </div>
                                                <div class="form-group bmd-form-group ">
                                                   <label for="expiry">Expiry Date & Time (required)</label>
                                                   <input type="text" class="form-control datetimepicker" name="expiry" aria-required="true" autocomplete="off">
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="tab-pane" id="snap">
                                       <h5 class="info-text"> Picture of Person <span class="text-danger"><b>(Required)</b></span> </h5>
                                       <div class="row justify-content-center">
                                          <div class="col-lg-12">
                                             <div class="row">
                                                <div class="col-md-12 col-lg-12">
                                                   <div class="button-group mr-auto text-center">

                                                      <input type="button" id="btn-start" class="btn btn-fill btn-wd btn-success" value="Start Streaming">
                                                     
                                                      <input type="button" id="btn-stop" class="btn btn-fill btn-wd btn-warning" value="Stop Streaming">

                                                      <input type="button" id="btn-capture" class="btn btn-fill btn-wd btn-info" value="Capture Image">
                                                     
                                                   </div>

                                                   <input type="hidden" name="captured_status" id="captured_status">

                                                   <div class="play-area">
                                                      <div class="play-area-sub text-center">
                                                         <div class="row">
                                                            <div class="col-md-12 col-lg-6 col-sm-12">
                                                               <div class="inside">
                                                                  <h3>Live Camera</h3>
                                                                  <video id="stream" width="300" height="300"></video>
                                                               </div>
                                                            </div>
                                                            <div class="col-md-12 col-lg-6 col-sm-12">
                                                               <div class="inside">
                                                                  <h3>Captured Image</h3>
                                                                  <canvas id="capture" width="300" height="300"></canvas>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>

                                                </div>
                                             </div>
                                             

                                          </div>
                                       </div>
                                    </div>
                                    <div class="tab-pane" id="preview">
                                    	<div class="row justify-content-center">

                                          <div class="col-lg-6 col-md-6 col-sm-12">
                                             <h6 class="info-text"> Profile Picture </h6>
                                             <div id="snapshot"></div>
                                          </div>
                                          <div class="col-lg-6 col-md-6 col-sm-12">
                                             <div class="col-12 col-sm-12">
                                                <div class="input-group form-control-lg">
                                                   <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                      <i class="material-icons">face</i>
                                                      </span>
                                                   </div>
                                                   <div class="form-group bmd-form-group is-filled">
                                                      <label for="set_name" class="bmd-label-floating">Name</label>
                                                      <input type="text" class="form-control" id="set_name" name="set_name" disabled>
                                                   </div>
                                                </div>
                                                <div class="input-group form-control-lg">
                                                   <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                      <i class="material-icons">email</i>
                                                      </span>
                                                   </div>
                                                   <div class="form-group bmd-form-group is-filled">
                                                      <label for="set_email" class="bmd-label-floating">Email</label>
                                                      <input type="text" class="form-control" id="set_email" name="set_email" disabled>
                                                   </div>
                                                </div>
                                                <div class="input-group form-control-lg">
                                                   <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                      <i class="material-icons">contact_phone</i>
                                                      </span>
                                                   </div>
                                                   <div class="form-group bmd-form-group is-filled">
                                                      <label for="set_phone" class="bmd-label-floating">Phone Number</label>
                                                      <input type="text" class="form-control" id="set_phone" name="set_phone" disabled>
                                                   </div>
                                                </div>
                                             
                                                <div class="input-group form-control-lg">
                                                   <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                      <i class="material-icons">face</i>
                                                      </span>
                                                   </div>
                                                   <div class="form-group bmd-form-group is-filled">
                                                      <label for="set_namev" class="bmd-label-floating">Name of Whom Visiting*</label>
                                                      <input type="text" class="form-control" id="set_namev" name="set_namev" disabled>
                                                   </div>
                                                </div>
                                                <div class="input-group form-control-lg">
                                                   <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                      <i class="material-icons">email</i>
                                                      </span>
                                                   </div>
                                                   <div class="form-group bmd-form-group is-filled">
                                                      <label for="set_emailv" class="bmd-label-floating">Email of Whom Visiting*</label>
                                                      <input type="text" class="form-control" id="set_emailv" name="set_emailv" disabled>
                                                   </div>
                                                </div>
                                                <div class="input-group form-control-lg">
                                                   <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                      <i class="material-icons">contact_phone</i>
                                                      </span>
                                                   </div>
                                                   <div class="form-group bmd-form-group is-filled">
                                                      <label for="set_phonev" class="bmd-label-floating">Number of Whom Visiting*</label>
                                                      <input type="text" class="form-control" id="set_phonev" name="set_phonev" disabled>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>

                                          

                                    	</div>
                                    </div>
                                 </div>
                              	<script type="text/javascript" src="assets/demo/capture.js"></script>
                              </div>
                              <div class="card-footer">
                                 <div class="mr-auto">
                                    <input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled" name="previous" value="Previous">
                                 </div>
                                 <div class="ml-auto">
                                    <input type="button" class="btn btn-next btn-fill btn-rose btn-wd" name="next" value="Next" id="next">
                                    <input type="submit" class="btn btn-finish btn-fill btn-rose btn-wd" name="submit" value="Save Data" id="finish" style="display: none;">

                                 </div>
                                 <div class="clearfix"></div>
                              </div>
                           </form>
                        </div>
                    </div>
                  </div>
               </div>
            </div>

            <?php include 'footer.php'; ?>

         </div>
      </div>
   </body>
   
   <script src="assets/js/core/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
   <script src="assets/js/core/popper.min.js"></script>
   <script src="assets/js/core/bootstrap-material-design.min.js"></script>
   <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
   <script src="assets/js/plugins/jquery.bootstrap-wizard.js"></script>
   <script src="assets/js/plugins/moment.min.js"></script>
   <script src="assets/js/plugins/sweetalert2.js"></script>
   <script src="assets/js/plugins/jquery.validate.min.js"></script>
   <script src="assets/js/plugins/bootstrap-selectpicker.js"></script>
   <script src="assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
   <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
   <script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
   <script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
   <script src="assets/js/plugins/fullcalendar.min.js"></script>
   <script src="assets/js/plugins/jquery-jvectormap.js"></script>
   <script src="assets/js/plugins/nouislider.min.js"></script>
   <script src="assets/js/plugins/arrive.min.js"></script>
   <script src="assets/js/plugins/chartist.min.js"></script>
   <script src="assets/js/plugins/bootstrap-notify.js"></script>
   <!-- <script src="https://buttons.github.io/buttons.js"></script> -->
   <script src="assets/js/material-dashboard.new.2020.js?v=2.1.2" type="text/javascript"></script>
   <script src="assets/demo/demo.js"></script>





   <script>

      $(document).ready(function() {
         // Initialise the wizard
         demo.initMaterialWizard();
         setTimeout(function() {
           $('.card.card-wizard').addClass('active');
         }, 600);
       
         $('#x').hide();
         $('#xx').hide();
         $('#update_logo_info').hide();
         $('#update_profile_info').show();
         //update_info();


         $('#select_teacher').change(function(){
          //var id= $('#teacher_name').val();
          var id= $(this).val();
          console.log(id);
          if(id != ''){
           $.ajax({
            url:"includes/fetch_teacher.php",
            method:"POST",
            data:{id:id},
            dataType:"JSON",
            success:function(data)
            {
              console.log(data);
             $('#emailv').val(data.email);
             $('#phonev').val(data.phone);
             $('#set_namev').val(data.name);
             $('#set_emailv').val(data.email);
             $('#set_phonev').val(data.phone);
             $('.emailv_input').addClass('has-success');
             $('.namev_input').addClass('has-success');
            }
           })
          }
          else
          {
           alert("Please Select Employee");
           $('#employee_details').css("display", "none");
          }
         });

         $('#name').on('keyup', function() {
            $('#set_name').val($('#name').val());
         });

         $('#email').on('keyup', function() {
            $('#set_email').val($('#email').val());
         });

         $('#phone').on('keyup', function() {
            $('#set_phone').val($('#name').val());
         });

      });

      function blink_text() {
         $('.blink').fadeOut(500);
         $('.blink').fadeIn(500);
      }
      setInterval(blink_text, 2500);

      // initialise Datetimepicker and Sliders
      demo.initDateTimePicker();

      $("#datetimepicker7").on("dp.change", function (e) {
        $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
      });
      

          
   </script>
   <?php include 'includes/common_modals.php'; ?>
</html>