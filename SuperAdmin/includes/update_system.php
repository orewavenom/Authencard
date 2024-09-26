<?php 
  
  include 'session.php';
  include 'connect_database.php';

  if(isset($_POST["name"])){

          $orgname          = mysqli_real_escape_string($db, $_POST["name"]); //Email variable
          $orgphone         = mysqli_real_escape_string($db, $_POST["phone"]); //password variable
          $orgmail          = mysqli_real_escape_string($db, $_POST["email"]); //institution variable
          $orgwebsite       = mysqli_real_escape_string($db, $_POST["website"]); //phone variable
          $year             = mysqli_real_escape_string($db, $_POST["year"]); //Firstname variable

          $image            = array('gif', 'png', 'jpg', 'jpeg', 'JPEG');
          $file             = $_FILES['profile']['name'];
          $ext              = pathinfo($file, PATHINFO_EXTENSION);

          if (in_array($ext, $image)) {
            $file_type = "IMAGE";
          }else{
            $file_type = "NONE";
          }

          $profile        = $_FILES['profile']['name'];
          $image_tmp      = $_FILES['profile']['tmp_name'];
          $size           = $_FILES["profile"]["size"];
          $temp           = explode(".", $profile);
          $extension      = end($temp);
          $filename       = basename($_FILES["profile"]["name"]);
          $filename       = 'org_logo.png'; // . strrchr($filename, '.');

          if ($file_type!='NONE') {

            if ($file_type=='NONE' && !empty($profile) || ($size > 2000000)) {
              echo json_encode(array("statusCode"=>203)); //Select Valid Attachment (Image Only Less Than 2MB)
            }else{

              if ($orgname=='' OR $orgphone=='' OR $orgmail==''  OR $orgwebsite=='' OR $year=='') {
                echo json_encode(array("statusCode"=>202)); //Please fill all the fileds (*)
              }else{

                $check = move_uploaded_file($image_tmp, "../media/".$filename);
                $insert = "UPDATE inorg SET name='$orgname', website='$orgwebsite', year='$year', email='$orgmail', phone='$orgphone' WHERE id='1' ";
                $run = mysqli_query($db, $insert);
                if ($check && $run) {
                  echo json_encode(array("statusCode"=>200));
                }else{
                  echo json_encode(array("statusCode"=>201));
                }
              }
              
              //echo json_encode(array("statusCode"=>203));
              
            }

          }else{

            if ($orgname=='' OR $orgphone=='' OR $orgmail=='' OR $orgwebsite=='' OR $year=='') {
                echo json_encode(array("statusCode"=>202)); //Please fill all the fileds (*)
              }else{
                $update = "UPDATE inorg SET name='$orgname', website='$orgwebsite', year='$year', email='$orgmail', phone='$orgphone' WHERE id='1' ";
                $run_update = mysqli_query($db, $update);
                if ($run_update) {
                  echo json_encode(array("statusCode"=>200));
                }else{
                  echo json_encode(array("statusCode"=>201));
                }
            }

          }
              
  }else{
    echo json_encode(array("statusCode"=>204));
  }

?>