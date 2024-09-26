<?php
  
  include 'includes/session.php';
  require "vendor/autoload.php";
  
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<title>card</title>
    <link href="https://fonts.googleapis.com/css?family=Manjari&display=swap" rel="stylesheet">
    <style>
      @import url('https://fonts.googleapis.com/css?family=Manjari&display=swap');
    </style>
    <link rel="stylesheet" type="text/css" href="assets/css/printbulk.css">

  </head>

  <body>

    <center><button id="btn" onclick="window.print();">Print This ID</button></center>
 
    <?php

      $from      = $_POST['getFrom'];
      $to        = $_POST['getTo'];

      if($to > $from)
      {
          $nfrom      = $from;
          $nto        = $to;
      }
      else if($to < $from)
      {
          $nfrom      = $to;
          $nto        = $from;

      }else{
          $nfrom      = $from;
          $nto        = $to;
      }

    	$sqluse ="SELECT * FROM inorg WHERE id='1' ";
      $retrieve = mysqli_query($db, $sqluse);
      $numb=mysqli_num_rows($retrieve); 

      $foundk = mysqli_fetch_array($retrieve);
      //$company_logo = $foundk['pname'];
      $company_name = $foundk['name'];

      $sqlmember ="SELECT * FROM new_users WHERE id>='$nfrom' AND id<='$nto' ";
    	$retrieve = mysqli_query($db, $sqlmember);
    	$count=0;

      while($found = mysqli_fetch_array($retrieve)){


        $id           = $found['id'];
        $title        = $found['title'];
        $name         = $found['name'];
        $guardian     = $found['guardian'];
        $address      = $found['address'];
        $phone        = $found['phone'];
        $email        = $found['email'];
        $designation  = $found['designation'];
        $dob          = $found['dob'];
        $blood_grp    = $found['blood_grp'];
        $student_id   = $found['student_id'];
        $profile      = $found['profile'];
        $created      = $found['created'];
        $newdob       = date("d-m-Y", strtotime($dob));
        $issuedate    = date("d-m-Y", strtotime($created));
        $count        = $count+1;
        $time         = time();

    		$serial       = $student_id;
        $Bar          = new Picqer\Barcode\BarcodeGeneratorHTML();
        $code         = $Bar->getBarcode($serial, $Bar::TYPE_CODE_128);
    						  
    ?>

    <div id="bg" align="center" class="page-break">

      <!-- Start Front ID Card -->
      <div id="id" class="mainCard">
        <div class="bgCard"></div>
        <table>
          <tr>
            <td>
              <?php
                if($numb!=0 ){
                  echo "<img src='media/org_logo.png'  width='50px' height='50px' style='padding-top: 5px;'>";
                }else{
    			    ?>
            	<img src="images/company_sample.png" alt="Avatar"  width="50px" height="50px">
              <?php } ?>
          	</td>
            <td>
              <font size="3.5" class="card_company_name">
                <b><?php echo strtoupper($company_name); ?></b>
              </font>
            </td>
          </tr>        
        </table>

				<center>
          <?php
            if($profile!=""){          
  						echo"<img src='images/".$profile."' height='140px' width='140px' style='margin-top: 5px; border: 2px solid black;'>";
  					}else{
  						echo"<img src='images/sample.png' height='140px' width='140px' style='margin-top: 5px; border: 2px solid black;'>";  
  					} 
          ?>
        </center>

        <div class="container" align="center">
          <br>
          <b>Holder ID: <?php if(isset($student_id)){ echo $student_id;} ?></b>

          <table class="table front_table" >
                  <tr>
                      <th>Full Name</th>
                      <td>:</td>
                      <td><b><?php if(isset($name)){ $namez=$title.'. '.$name; echo $namez;} ?></b></td>
                  </tr>
                  <tr>
                      <th>Guardian</th>
                      <td>:</td> 
                      <td><?php if(isset($guardian)){ echo $guardian;} ?></td>
                  </tr>
                  <tr>
                      <th>Phone</th> 
                      <td>:</td>
                      <td><?php if(isset($phone)){ echo $phone;} ?></td>
                  </tr>
                  <tr>
                      <th>Email</th> 
                      <td>:</td>
                      <td><?php if(isset($email)){ echo $email;} ?></td>
                  </tr>
                  <tr>
                      <th>DOB</th> 
                      <td>:</td>
                      <td><?php if(isset($newdob)){ echo $newdob;} ?></td>
                  </tr>
                  <tr>
                      <th>Blood Group</th> 
                      <td>:</td>
                      <td><?php if(isset($blood_grp)){ echo $blood_grp;} ?></td>
                  </tr>
                  <tr>
                      <th>Designation</th> 
                      <td>:</td>
                      <td><?php if(isset($designation)){ echo $designation;} ?></td>
                  </tr>
                  <tr>
                      <th>Issue Date</th> 
                      <td>:</td>
                      <td><?php if(isset($issuedate)){ echo $issuedate;} ?></td>
                  </tr>
                  <tr>
                      <th>Address</th> 
                      <td>:</td>
                      <td><?php if(isset($address)){ echo $address;} ?></td>
                  </tr>
                </table>  
                        
        </div>

      </div>
      <!-- End Front ID Card -->
      

      <!-- ID Backside Section -->
      <div class="id-1">
        <center>
          <img src="media/org_logo.png" alt="Avatar" width="100px" height="100px" class="card_bk_logo">
          <div class="container" align="center">
            <h2 class="card_bk_company"><?php echo $company_name; ?></h2>
            <p class="card_bk_pt">* Always Diplay ID-Card</p>
            <p class="card_bk_pt">* Notify to administrator in case of loss.</p>
            <p class="card_bk_pt">* If lost and found please return to the <br> nearest police station.</p>
          </div>
          <img src="media/signature.png" width="120" class="card_signature">
          <hr align="center" class="card_bk_hr">
          <p align="center" class="card_signature_title">Authorised Signature</p>
          <div class="card_bk_div"></div>
          <p> <?php if(isset($code)){ echo $code;}?> </p>
          <?php if(isset($company_name)){ echo"Property of ".$company_name;}?>
        </center>
      </div>
      <!-- End ID Backside Section -->

    </div>

    <?php } ?>
    
  </body>
</html>
