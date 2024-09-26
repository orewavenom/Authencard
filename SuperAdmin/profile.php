<?php 
  
  include 'session.php';

  include_once('includes/connect_database.php');
  
  $client_lang['10'] = '<div class="alert alert-danger text-center"><font size="3">Please fill all the fileds.</font></div><br>';
  $client_lang['11'] = '<div class="alert alert-success text-center"><font size="3">Successfully Updated.</font></div><br>';
  $client_lang['12'] = '<div class="alert alert-danger text-center"><font size="3">Something went wrong.</font></div><br>';
  $client_lang['13'] = '<div class="alert alert-warning text-center"><font size="3">Image size must be less than 2MB.</font></div><br>';
  $client_lang['14'] = '<div class="alert alert-danger text-center"><font size="3">Selected file is not an image.</font></div><br>';
  
  if(isset($_POST['finish'])){

          // create array variable to handle error
          $error = array();

          function generateRandomString($length = 10) {
              $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
              $charactersLength = strlen($characters);
              $randomString = '';
              for ($i = 0; $i < $length; $i++) {
                  $randomString .= $characters[rand(0, $charactersLength - 1)];
              }
              return $randomString;
          }

          $semail          = $_SESSION['college_session'];
          $college        = mysqli_escape_string($connect, $_POST['college']);
          $principal      = mysqli_escape_string($connect, $_POST['principal']);
          $code           = mysqli_escape_string($connect, $_POST['code']);
          //$course         = mysqli_escape_string($connect, $_POST['course']);
          $address        = mysqli_escape_string($connect, $_POST['address']);
          $taluka         = mysqli_escape_string($connect, $_POST['taluka']);
          $city           = mysqli_escape_string($connect, $_POST['city']);
          $pin            = mysqli_escape_string($connect, $_POST['pin']);
          $website        = mysqli_escape_string($connect, $_POST['website']);
          $phone          = mysqli_escape_string($connect, $_POST['phone']);
          $email          = mysqli_escape_string($connect, $_POST['email']);

          $course = '';
          foreach($_POST["course"] as $branches){
            $course .= $branches . ', ';
          }

          $created          = date("F j, Y h:i: A");

          $image            = array('gif', 'png', 'jpg', 'jpeg', 'JPEG');
          $file             = $_FILES['logo']['name'];
          $ext              = pathinfo($file, PATHINFO_EXTENSION);

          if (in_array($ext, $image)) {
            $file_type = "IMAGE";
          }

          $attachment     = $_FILES['logo']['name'];
          $image_tmp      = $_FILES['logo']['tmp_name'];
          $temp           = explode(".", $attachment);
          $extension      = end($temp);
          $filename       = basename($_FILES["logo"]["name"]);
          $filename       = generateRandomString() . strrchr($filename, '.');
          
          $size = filesize($image_tmp);

          if ($file_type!='IMAGE') {
            $_SESSION['msg']="14";
                header("Location: profile.php");
                exit;
          }else{
              
            if ($size > 2000000) {
                $_SESSION['msg']="13";
                header("Location: profile.php");
                exit;
            }else{

                if ($college=='' OR $principal=='' OR $code=='' OR $course=='' OR $address=='' OR $taluka=='' OR $city=='' OR $pin=='' OR $website=='') {
                    $_SESSION['msg']="10";
                    header("Location: profile.php");
                    exit;
                }else{
    
                    move_uploaded_file($image_tmp, "uploads/logo/".$filename);
              
                    $insert = "INSERT INTO college_profiles (college_code, college_email, name, logo, principal, courses, address, taluka, city, pin, website, phone, email, status, created)  VALUES ('$code', '$semail', '$college', '$filename', '$principal', '$course', '$address', '$taluka', '$city', '$pin', '$website', '$phone', '$email', '0', '$created')";
    
                    $run = mysqli_query($connect, $insert);
                    if ($run) {
                        
                        unset($_SESSION['college_profile']);
            	        $_SESSION['college_profile'] = '333';
                        
                        mysqli_query($connect, "UPDATE college_login SET acc_status='3' WHERE email='$semail'");
        	        
                        $_SESSION['msg']="11";
                        header("Location: profile.php");
                        exit;
                    }else{
                        $_SESSION['msg']="12";
                        header("Location: profile.php");
                        exit;
                    }
    
                    
                }
            
            }

          }

  }
          
  if(isset($_POST['update'])){

          // create array variable to handle error
          $error = array();

          $semail         = $_SESSION['college_session'];
          $college        = mysqli_escape_string($connect, $_POST['college']);
          $principal      = mysqli_escape_string($connect, $_POST['principal']);
          $code           = mysqli_escape_string($connect, $_POST['code']);
          $courses        = mysqli_escape_string($connect, $_POST['course']);
          $address        = mysqli_escape_string($connect, $_POST['address']);
          $taluka         = mysqli_escape_string($connect, $_POST['taluka']);
          $city           = mysqli_escape_string($connect, $_POST['city']);
          $pin            = mysqli_escape_string($connect, $_POST['pin']);
          $website        = mysqli_escape_string($connect, $_POST['website']);
          $phone          = mysqli_escape_string($connect, $_POST['phone']);
          $email          = mysqli_escape_string($connect, $_POST['email']);

          $course = '';
          foreach($_POST['course'] as $branches){
            $course .= $branches . ', ';
          }

          $created          = date("F j, Y h:i: A");
          
        if ($college=='' OR $principal=='' OR $code=='' OR $course=='' OR $address=='' OR $taluka=='' OR $city=='' OR $pin=='' OR $website=='') {
            $error['update'] = '<div class="alert alert-danger text-center"><font size="3">Please fill all the fileds.</font></div><br>';
            $_SESSION['msg']="10";
            header("Location: profile.php");
            exit;
        }else{
            
            $update = "UPDATE college_profiles SET college_code='$code', name='$college', principal='$principal', courses='$course', address='$address', taluka='$taluka', city='$city', pin='$pin', website='$website', phone='$phone', email='$email' WHERE college_email='$semail' ";

            $run = mysqli_query($connect, $update);
            if ($run) {
                $_SESSION['msg']="11";
                $error['update'] = '<div class="alert alert-success text-center"><font size="3">Successfully Updated.</font></div><br>';
                header("Location: profile.php");
                exit;
            }else{
                $_SESSION['msg']="12";
                $error['update'] = '<div class="alert alert-danger text-center"><font size="3">Something Went Wrong.</font></div><br>';
                header("Location: profile.php");
                exit;
            }

            
        }

  }
  
  if(isset($_POST['logoUpdate'])){

          // create array variable to handle error
          $error = array();

          function generateRandomString($length = 10) {
              $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
              $charactersLength = strlen($characters);
              $randomString = '';
              for ($i = 0; $i < $length; $i++) {
                  $randomString .= $characters[rand(0, $charactersLength - 1)];
              }
              return $randomString;
          }

          $semail          = $_SESSION['college_session'];
          $old             = $_POST['old']; 

          $image            = array('gif', 'png', 'jpg', 'jpeg', 'JPEG');
          $file             = $_FILES['ulogo']['name'];
          $ext              = pathinfo($file, PATHINFO_EXTENSION);

          if (in_array($ext, $image)) {
            $file_type = "IMAGE";
          }

          $attachment     = $_FILES['ulogo']['name'];
          $image_tmp      = $_FILES['ulogo']['tmp_name'];
          $temp           = explode(".", $attachment);
          $extension      = end($temp);
          $filename       = basename($_FILES["ulogo"]["name"]);
          $filename       = generateRandomString() . strrchr($filename, '.');
          
          $size = filesize($image_tmp);

          if ($file_type!='IMAGE') {
            $_SESSION['msg']="14";
            header("Location: profile.php");
            exit;
          }else{

            if ($size > 2000000) {
                $_SESSION['msg']="13";
                header("Location: profile.php");
                exit;
            }else{
                
                unlink("uploads/logo/".$old);
                move_uploaded_file($image_tmp, "uploads/logo/".$filename);
          
                $update = "UPDATE college_profiles SET logo='$filename' WHERE college_email='$semail' ";
                $run = mysqli_query($connect, $update);
                
                if ($run) {
                    $_SESSION['msg']="11";
                    header("Location: profile.php");
                    exit;
                }else{
                    $_SESSION['msg']="12";
                    header("Location: profile.php");
                    exit;
                }

                
            }

          }

  }
  
?>

<!DOCTYPE html>
<html lang="en" class="perfect-scrollbar-on">

<head>
  <?php include 'meta.php'; ?>
  <link href="assets/demo/demo.css" rel="stylesheet">
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

  </style>
</head>

<body data-gr-c-s-loaded="true"> <!-- class="sidebar-mini" -->

  <div class="wrapper ">

    <!-- Side Nav -->
    <?php include 'side_nav.php'; ?>

    <div class="main-panel">

      <!-- Navbar -->
      <?php include "top_right_nav.php"; ?>
      <!-- End Navbar -->

      
      <div class="content">
        <div class="container-fluid">
          
          <div class="col-md-8 col-12 mr-auto ml-auto">
            <?php if(isset($_SESSION['msg'])){?>
              <?php echo $client_lang[$_SESSION['msg']] ; ?>
            <?php unset($_SESSION['msg']);}?>
          </div>
          
          <?php if ($_SESSION['college_profile']=='222') { ?>

          <div class="col-md-8 col-12 mr-auto ml-auto">
              
            <?php echo isset($error['success']) ? $error['success'] : '';?>
            <?php echo isset($error['empty']) ? $error['empty'] : '';?>

            <!-- Wizard container -->
            <div class="wizard-container">
              <div class="card card-wizard" data-color="rose" id="wizardProfile">
                <form method="POST" enctype="multipart/form-data">
                  <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                  <div class="card-header text-center mt-3">
                    <h3 class="card-title">
                      Build Your College Profile
                    </h3>
                    <h5 class="card-description">This information will let students know more about you.</h5>
                  </div>
                  <div class="wizard-navigation">
                    <ul class="nav nav-pills">
                      <li class="nav-item">
                        <a class="nav-link active" href="#about" data-toggle="tab" role="tab" id="about_tab">
                          About
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " href="#account" data-toggle="tab" role="tab" id="account_tab">
                          Courses
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " href="#address" data-toggle="tab" role="tab" id="address_tab">
                          Address
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane active" id="about"> <!-- active -->
                        <h5 class="info-text"> Let's start with the basic information</h5>
                        <div class="row justify-content-center">
                          <div class="col-sm-4">
                            <div class="picture-container">
                              <div class="picture">
                                <img src="assets/img/college.jpg" class="picture-src" id="wizardPicturePreview" title="College Logo" />
                                <input type="file" id="wizard-picture" name="logo" required>
                              </div>
                              <h6 class="description">Choose College Logo</h6>
                              <p class="text-danger">Required*</p>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="input-group form-control-lg">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">face</i>
                                </span>
                              </div>
                              <div class="form-group">
                                <label for="College" class="bmd-label-floating">Name of College (required)</label>
                                <input type="text" class="form-control" id="College" name="college" required >
                              </div>
                            </div>
                            <div class="input-group form-control-lg">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">record_voice_over</i>
                                </span>
                              </div>
                              <div class="form-group">
                                <label for="Principal" class="bmd-label-floating">Name of Principal (required)</label>
                                <input type="text" class="form-control" id="Principal" name="principal" required >
                              </div>
                            </div>
                            <div class="input-group form-control-lg">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">record_voice_over</i>
                                </span>
                              </div>
                              <div class="form-group">
                                <label for="Code" class="bmd-label-floating">College Code (required)</label>
                                <input type="text" class="form-control" id="Code" name="code" required >
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane" id="account">
                        <h5 class="info-text"> Which courses do you have? <span class="text-danger"><b>(Required)</b></span> </h5>
                        <div class="row justify-content-center">
                          <div class="col-lg-12">
                            <div class="row">
                              
                              <?php
                            
                                $semail        = $_SESSION['college_session'];

                                $query = mysqli_query($connect, "SELECT * FROM `college_engg_branch` ORDER BY id ASC");
                                $total_post = mysqli_num_rows($query);
        
                                  while ($query_row = mysqli_fetch_assoc($query)) {
        
                                    $id               = $query_row['id'];
                                    $branch         = $query_row['name'];
                                    
        
                            ?>
                    

                              <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="choice" data-toggle="wizard-checkbox">
                                  <input type="checkbox" name="course[]" value="<?php echo $branch; ?>" id="<?php echo $branch; ?>" class="valid" >
                                  <div class="icon">
                                    <i class="fa fa-graduation-cap"></i>
                                  </div>
                                  <h6><?php echo $branch; ?></h6>
                                </div>
                              </div>
                              
                              <?php }  ?>

                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane" id="address">
                        <div class="row justify-content-center">
                          <div class="col-sm-12">
                            <h5 class="info-text"> Are you living in a nice area? </h5>
                          </div>
                          <div class="col-sm-10">
                            <div class="form-group">
                              <label>Address</label>
                              <input type="text" class="form-control" required id="address" name="address">
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-group">
                              <label>Taluka</label>
                              <input type="text" class="form-control" required id="taluka" name="taluka">
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-group">
                              <label>City</label>
                              <input type="text" class="form-control" required id="city" name="city">
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-group">
                              <label>Pin</label>
                              <input type="number" class="form-control" required id="pin" name="pin">
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-group">
                              <label>Website</label>
                              <input type="url" class="form-control" required id="website" name="website">
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-group">
                              <label>Phone</label>
                              <input type="number" class="form-control" required id="phone" name="phone">
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-group">
                              <label>Email</label>
                              <input type="email" class="form-control" required id="email" name="email">
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="mr-auto">
                      <input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled" name="previous" value="Previous">
                    </div>
                    <div class="ml-auto">
                      <input type="button" class="btn btn-next btn-fill btn-rose btn-wd" name="next" value="Next" id="next">
                      <input type="submit" class="btn btn-finish btn-fill btn-rose btn-wd" name="finish" value="Save" id="finish" style="display: none;">
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </form>
              </div>
            </div>
            <!-- wizard container -->
          </div>

          <?php } ?> <!-- sdsadasd -->


          <?php

          if ($_SESSION['college_profile']=='333' || $_SESSION['college_profile']=='444') {

          include_once('includes/connect_database.php');

          $email        = $_SESSION['college_session'];
          $select_query = "SELECT * FROM college_profiles WHERE college_email='$email' ";
          $result       = mysqli_query($connect, $select_query);
          $row1         = mysqli_fetch_array($result);

          $id             = $row1["id"];
          $college_code   = $row1["college_code"];
          $college_email  = $row1["college_email"];
          $name           = $row1["name"];
          $logo           = $row1["logo"];
          $principal      = $row1["principal"];
          $courses        = $row1["courses"];
          $address        = $row1["address"];
          $taluka         = $row1["taluka"];
          $city           = $row1["city"];
          $pin            = $row1["pin"];
          $website        = $row1["website"];
          $phone          = $row1["phone"];
          $email          = $row1["email"];
          $status         = $row1["status"];
          $created        = $row1["created"];

          if ($status=='1' ) {
            $badge = '<i class="material-icons text-success">done_outline</i>';
            $color = 'text-success';
            $button = '<a href="javascript:;" class="btn btn-success btn-round">Verified</a> <a href="javascript:;" onclick="update_info()" class="btn btn-rose btn-round">Update Info</a> <a href="javascript:;" onclick="update_logo()" class="btn btn-rose btn-round">Update Logo</a> ';
          }else{
            $badge = '<i class="material-icons text-warning">hourglass_empty</i>';
            $color = 'text-warning';
            $button = '<a href="javascript:;" class="btn btn-round btn-warning blink">Profile verification under process</a>';
          }

          ?>

          <div class="col-md-8 col-12 mr-auto ml-auto mt-5" id="profile_card">
            <div class="card card-profile">
                <div class="card-avatarr">
                  <a href="javascript:;">
                    <img class="img college-logo" src="<?php echo 'uploads/logo/'.$logo; ?>" width="100%" />
                  </a>
                </div>
                <div class="card-body">
                  <h5 class="card-category text-gray"><?php echo $name; ?> (<span class="<?php echo $color; ?>"><b><?php echo $college_code; ?></b></span>) <?php echo $badge; ?></h5>
                  <h4 class="card-title"><?php echo $principal; ?> (<span class="<?php echo $color; ?>"><b>Principal</b></span>)</h4>
                  <p class="card-description college-address">
                    <?php echo $address.', '.$taluka.', '.$city.', '.$pin.'.'; ?>
                  </p>
                  <div class="col-md-12 col-lg-12 col-sm-12 justify-content-center">
                    <a class="btn-custom btn-info-custom">
                        <span class="btn-label">
                          <i class="material-icons">language</i>
                        </span>
                        <?php echo $website; ?>
                    </a>
                    <a class="btn-custom btn-info-custom">
                      <span class="btn-label">
                        <i class="material-icons">alternate_email</i>
                      </span>
                      <?php echo $email; ?>
                    </a>
                    <a class="btn-custom btn-info-custom">
                      <span class="btn-label">
                        <i class="material-icons">phone</i>
                      </span>
                      +91 <?php echo $phone; ?>
                    </a>
                  </div>
                  <br>
                  <?php echo $button; ?>
                     
                </div>
            </div>
          </div>

          <?php } ?> <!-- If college_session is (not registered) -->
          
          
          <div class="col-md-8 col-12 mr-auto ml-auto">
            
            <?php
            
              $email        = $_SESSION['college_session'];
              $select_query = "SELECT * FROM college_profiles WHERE college_email='$email' ";
              $result       = mysqli_query($connect, $select_query);
              $row1         = mysqli_fetch_array($result);
    
              $id             = $row1["id"];
              $college_code   = $row1["college_code"];
              $college_email  = $row1["college_email"];
              $name           = $row1["name"];
              $logo           = $row1["logo"];
              $principal      = $row1["principal"];
              $courses        = $row1["courses"];
              $address        = $row1["address"];
              $taluka         = $row1["taluka"];
              $city           = $row1["city"];
              $pin            = $row1["pin"];
              $website        = $row1["website"];
              $phone          = $row1["phone"];
              $email          = $row1["email"];
              $status         = $row1["status"];
              $created        = $row1["created"];
            
            ?>

            <!-- Wizard container -->
            <div class="wizard-container" id="update_profile_info" style="position: relative;">
                
                <button id="x" class="btn btn-danger btn-round btn-fab" onclick="update_cancel()" style="display:none;">
                    <i class="material-icons">close</i>
                </button>
                
              <div class="card card-wizard" data-color="rose" id="wizardProfile">
                <form method="POST" enctype="multipart/form-data">
                  <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
                  <div class="card-header text-center mt-3">
                    <h3 class="card-title">
                      Update Your College Profile
                    </h3>
                    <h5 class="card-description">This information will let students know more about you.</h5>
                  </div>
                  <div class="wizard-navigation">
                    <ul class="nav nav-pills">
                      <li class="nav-item">
                        <a class="nav-link active" href="#about" data-toggle="tab" role="tab" id="about_tab">
                          About
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " href="#account" data-toggle="tab" role="tab" id="account_tab">
                          Courses
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " href="#address" data-toggle="tab" role="tab" id="address_tab">
                          Address
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane active" id="about"> <!-- active -->
                        <h5 class="info-text"> Let's start with the basic information</h5>
                        <div class="row justify-content-center">
                          <div class="col-sm-10">
                            <div class="input-group form-control-lg">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">face</i>
                                </span>
                              </div>
                              <div class="form-group">
                                <label for="College" class="bmd-label-floating">Name of College (required)</label>
                                <input type="text" class="form-control" id="College" name="college" required value="<?php echo $name; ?>" >
                              </div>
                            </div>
                            <div class="input-group form-control-lg">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">record_voice_over</i>
                                </span>
                              </div>
                              <div class="form-group">
                                <label for="Principal" class="bmd-label-floating">Name of Principal (required)</label>
                                <input type="text" class="form-control" id="Principal" name="principal" required value="<?php echo $principal; ?>" >
                              </div>
                            </div>
                            <div class="input-group form-control-lg">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="material-icons">record_voice_over</i>
                                </span>
                              </div>
                              <div class="form-group">
                                <label for="Code" class="bmd-label-floating">College Code (required)</label>
                                <input type="text" class="form-control" id="Code" name="code" required value="<?php echo $phone; ?>" >
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane" id="account">
                        <h5 class="info-text"> Which courses do you have? <span class="text-danger"><b>(Required)</b></span> </h5>
                        <div class="row justify-content-center">
                          <div class="col-lg-12">
                            <div class="row">
                            
                            
                                <?php
                                    
                                    include_once('includes/connect_database.php');
                                    $branches = array();
                                    $query = mysqli_query($connect, "SELECT * FROM `college_engg_branch`");
                                    while ($query_row = mysqli_fetch_assoc($query)) {
                                        $branches[] = $query_row["name"]; 
                                        //$all_branches = implode(", ", $branches);
                                    } 
                                    //$all_branches = implode(", ", $branches);
                                    
                                    $semail         = $_SESSION['college_session'];
                                    $query_cb       = mysqli_query($connect, "SELECT courses FROM `college_profiles` WHERE college_email='$semail' ");
                                    $query_row_cb   = mysqli_fetch_assoc($query_cb);
                                    $divide         = explode(", ", $query_row_cb['courses']);
                                    
                                    /*echo print_r($branches).'<br><br>*****<br><br>';
                                    echo print_r($divide).'<br>';
                                    $i = 0;*/
                                    
                                    foreach($branches as $result){
                                        
                                        if($result==$divide[0] OR $result==$divide[1] OR $result==$divide[2] OR $result==$divide[3] OR $result==$divide[4] OR $result==$divide[5] OR $result==$divide[6] OR $result==$divide[7] OR $result==$divide[8] OR $result==$divide[9] OR $result==$divide[10] OR $result==$divide[11] OR $result==$divide[12] OR $result==$divide[13] OR $result==$divide[14] OR $result==$divide[15] )
                                        {
                                            
                                    ?>
                                     
                                     <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="choice active" data-toggle="wizard-checkbox">
                                          <input 1 type="checkbox" checked="checked" name="course[]" value="<?php echo $result; ?>"  id="<?php echo $result; ?>" class="valid" >
                                          <div class="icon">
                                            <i class="fa fa-graduation-cap"></i>
                                          </div>
                                          <h6><?php echo $result; ?></h6>
                                        </div>
                                      </div>
                                     
                                     <?php } else { ?>
                                     
                                     <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="choice" data-toggle="wizard-checkbox">
                                          <input 2 type="checkbox" name="course[]" value="<?php echo $result; ?>"  id="<?php echo $result; ?>" class="valid" >
                                          <div class="icon">
                                            <i class="fa fa-graduation-cap"></i>
                                          </div>
                                          <h6><?php echo $result; ?></h6>
                                        </div>
                                      </div>
                                     
                                     
                                <?php } } ?>

                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane" id="address">
                        <div class="row justify-content-center">
                          <div class="col-sm-12">
                            <h5 class="info-text"> Are your instutute in a nice area? </h5>
                          </div>
                          <div class="col-sm-10">
                            <div class="form-group">
                              <label>Address</label>
                              <input type="text" class="form-control" required id="address" name="address" value="<?php echo $address; ?>" >
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-group">
                              <label>Taluka</label>
                              <input type="text" class="form-control" required id="taluka" name="taluka" value="<?php echo $taluka; ?>" >
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-group">
                              <label>City</label>
                              <input type="text" class="form-control" required id="city" name="city" value="<?php echo $city; ?>" >
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-group">
                              <label>Pin</label>
                              <input type="number" class="form-control" required id="pin" name="pin" value="<?php echo $pin; ?>" >
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-group">
                              <label>Website</label>
                              <input type="url" class="form-control" required id="website" name="website" value="<?php echo $website; ?>" >
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-group">
                              <label>Phone</label>
                              <input type="number" class="form-control" required id="phone" name="phone" value="<?php echo $phone; ?>" >
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-group">
                              <label>Email</label>
                              <input type="email" class="form-control" required id="email" name="email" value="<?php echo $email; ?>" >
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="mr-auto">
                      <input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled" name="previous" value="Previous">
                    </div>
                    <div class="ml-auto">
                      <!--<input type="button" class="btn btn-fill btn-danger btn-wd" onclick="update_cancel()" value="Cancel" id="cancel">-->
                      <input type="button" class="btn btn-next btn-fill btn-rose btn-wd" name="next" value="Next" id="next">
                      <input type="submit" class="btn btn-finish btn-fill btn-rose btn-wd" name="update" value="Update" id="finish" style="display: none;">
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </form>
              </div>
            </div>
            <!-- wizard container -->
            
            
            <div class="col-md-12" id="update_logo_info">
                
                <button id="xx" class="btn btn-danger btn-round btn-fab" onclick="update_cancel()" style="display:none;">
                    <i class="material-icons">close</i>
                </button>
                
              <div class="card">
                <div class="card-header card-header-rose card-header-text">
                  <div class="card-text">
                    <h4 class="card-title">Update Institute's Logo</h4>
                  </div>
                </div>

                <form id="updateCollegePhoto" method="post" enctype="multipart/form-data">
                
                <div class="card-body">

                  <!-- Institute Logo Update -->
                  <div class="row">
                    <div class="col-md-4 offset-md-5">
                      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail img-circle">
                          <img src="uploads/logo/<?php echo $logo; ?>" alt="Institute Logo">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                        <div class="form-group">
                          <span class="btn btn-round btn-rose btn-file">
                            <span class="fileinput-new">Change Logo</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="ulogo" required="true" accept="image/*">
                            <input type="hidden" name="old" value="<?php echo $logo; ?>">
                            <input type="hidden" name="token" value="<?php echo base64_encode($id); ?>">
                          </span>
                          <br>
                          <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                          <p class="text-info">Image less than 2MB *</p>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="card-footer text-right">
                    <div class="form-check mr-auto">
                        <label class="form-check-label"></label>
                    </div>
                    <input type="button" class="btn btn-fill btn-rose btn-wd" onclick="update_cancel()" value="Cancel" id="cancel">
                    <input type="submit" class="btn btn-success" name="logoUpdate" value="Update Logo">
                </div>

                </form>

              </div>

              <!-- saperate the form -->

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
  <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="assets/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="assets/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="assets/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="assets/js/plugins/arrive.min.js"></script>
  <!-- Chartist JS -->
  <script src="assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!--https://buttons.github.io/buttons.js-->
  <script src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.new.2020.js?v=2.1.2" type="text/javascript"></script>
  <!--<script src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/material-dashboard.min.js?v=2.2.2" type="text/javascript"></script>-->
  <!--https://demos.creative-tim.com/material-dashboard-pro/assets/js/material-dashboard.min.js?v=2.2.2-->
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
      $('#update_profile_info').hide();
      
    });

    function blink_text() {
        $('.blink').fadeOut(500);
        $('.blink').fadeIn(500);
    }
    setInterval(blink_text, 2500);
    
    function update_logo() {
      $('#profile_card').hide();
      $('#xx').show();
      $('#x').hide();
      $('#update_logo_info').show();
      $('#update_profile_info').hide();
    }
    
    function update_info(){
      $('#profile_card').hide();
      $('#x').show();
      $('#xx').hide();
      $('#update_profile_info').show();
      $('#update_logo_info').hide();
    }
    
    function update_cancel(){
      $('#profile_card').show();
      $('#xx').hide();
      $('#x').hide();
      $('#update_profile_info').hide();
      $('#update_logo_info').hide();
    }
        
  </script>

</html>