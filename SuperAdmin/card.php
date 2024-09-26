<?php

  include 'includes/session.php';
  require "vendor/autoload.php";
  include_once('includes/connect_database.php');

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>

		<title>eCard Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Manjari&display=swap" rel="stylesheet">
    <style>
      @import url('https://fonts.googleapis.com/css?family=Manjari&display=swap');
    </style>

    <link rel="stylesheet" type="text/css" href="../assets/css/printcard.css">

    <script src="../https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> 

    <script type="text/JavaScript" src="../https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"></script>

</head>

<?php

  $sqluse = "SELECT * FROM inorg WHERE id='1' ";
  $retrieve = mysqli_query($db, $sqluse);
  $numb = mysqli_num_rows($retrieve);

  $foundk = mysqli_fetch_array($retrieve);
  //$company_logo = $foundk['pname'];
  $company_name = $foundk['name'];

?>

<body>

<center><button id="btn">Print This ID</button></center>


          <div id="bg">


            <!-- ID Front Section --> 
            <div id="id">

              <!-- Header Of Front ID Card -->
            	<table>
                <tr>
                  <td>
                    <?php
                      if($numb!=0 ){
                        echo "<img src='../media/org_logo.png' width='50px' height='50px' alt='' style='padding-top: 5px;'>";
                      }else{
                    ?>
                      <img src="../images/company_sample.png" alt="Avatar"  width="50px" height="50px">
                    <?php } ?>
                  </td>
                  <td>
                    <font size="3.5" class="card_company_name">
                      <b><?php echo strtoupper($company_name); ?></b>
                    </font>
                  </td>
                </tr>        
              </table>

              <!-- Body Of Front ID Card -->
              <center>

                <?php  

                  $idx = $_GET['id'];
                  $sqlmember ="SELECT * FROM visitors WHERE id='$idx' ";
              		$retrievem = mysqli_query($db,$sqlmember);
              		$count=0;
                                          
                    while($found = mysqli_fetch_array($retrievem)){

                      $id           =$found['id'];
                      $name         =$found['name'];
                      $email        =$found['email'];
                      $phone        =$found['phone'];
                      $namev        =$found['namev'];

                      $t_result = mysqli_query($db, "SELECT * FROM teachers WHERE id = '$namev'");
                      $row     = mysqli_fetch_array($t_result);
                      $namev = $row['name'];

                      $phonev       =$found['phonev'];
                      $emailv       =$found['emailv'];
                      $expiry       =$found['expiry'];
                      $seo_url       =$found['seo_url'];
                      $status       =$found['status'];
                      $profile       =$found['profile'];
                      $created      =$found['created'];

              			}  	 

                    if($profile!=""){          
            						echo"<img src='../images/uploads/".$profile."' height='140px' width='140px' alt='' style='border: 2px solid black; margin-top: 5px;'>";	   
            				}else{
            					echo"<img src='../images/sample.png' height='140px' width='140px' alt='' style='border: 2px solid black; margin-top: 5px;'>";	   
            				}

                    /*$idx        = $_GET['id'];
                    $sqlmember  = "SELECT * FROM new_users WHERE id='$idx' ";
                    $retrieveq   = mysqli_query($db,$sqlmember);
                    $forQRCode  = mysqli_fetch_array($retrieveq);
                    $serial     = $forQRCode['student_id'];*/
                    $Bar        = new Picqer\Barcode\BarcodeGeneratorHTML();
                    $code       = $Bar->getBarcode($phone, $Bar::TYPE_CODABAR);

                ?>
              </center>

              <div class="container" align="center" style="margin-top: 10px; font-size: 15px;">
                <b>Visitors ID: <?php if(isset($student_id)){ echo $student_id;} ?></b>
                <table class="table" style="width:100%">
                  <tr>
                      <th>Full Name</th>
                      <td>:</td>
                      <td><b><?php echo $name; ?></b></td>
                  </tr>
                  <tr>
                      <th>Phone</th>
                      <td>:</td> 
                      <td><?php echo $phone; ?></td>
                  </tr>
                  <tr>
                      <th>Email</th> 
                      <td>:</td>
                      <td><?php echo $email; ?></td>
                  </tr>
                  <tr>
                      <th>Whom to Meet</th> 
                      <td>:</td>
                      <td><?php echo $namev; ?></td>
                  </tr>
                  <tr>
                      <th>Expiry</th> 
                      <td>:</td>
                      <td><?php echo $expiry; ?></td>
                  </tr>
                  <tr>
                      <th>Issue Date</th> 
                      <td>:</td>
                      <td><?php echo $created ?></td>
                  </tr>
                  
                </table>       
              </div>

            </div>
            <!-- End ID Front Section -->


            <!-- ID Backside Section -->
            <div class="id-1">
              <center>     
                <img src="../media/org_logo.png" class="card_bk_logo" alt="Avatar" width="100px" height="100px">
                <div class="container" align="center">
                  <h2 class="card_bk_company"><?php echo $company_name; ?></h2>
                  <p class="card_bk_pt">* Always Diplay ID-Card</p>
                  <p class="card_bk_pt">* Notify to administrator in case of loss.</p>
                  <p class="card_bk_pt">* If lost and found please return to the <br> nearest police station.</p>
                </div>
                  <img src="../media/signature.png" width="120" class="card_signature">
                  <hr align="center" class="card_bk_hr">
                  <p align="center" class="card_signature_title">Authorised Signature</p>
                  <div class="card_bk_div"></div>
                  <p class="card_bk_barcode"> <?php if(isset($code)){ echo $code;}?> </p>
                  <?php if(isset($company_name)){ echo"Property of ".$company_name;}?>
              </center>
            </div>
            <!-- End ID Backside Section -->


          </div>

<script>
  $("#btn").click(function () {
      $("#bg").print();
  });
</script>          

</body>
</html>
