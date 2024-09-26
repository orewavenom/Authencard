<?php 

session_start();
if (!isset($_SESSION['super_edustrator'])) {
	header("location: login.php");
}

function password($length = 8) {
  $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

include_once('includes/connect_database.php');
date_default_timezone_set('Asia/Kolkata');

if (isset($_POST['submit'])) {
	    
	$code       = mysqli_escape_string($connect, $_POST['code']);
	$email 		= mysqli_escape_string($connect, $_POST['email']);
	$pwd 	    = mysqli_escape_string($connect, $_POST['pwd']);
	$npassword 	= md5($pwd);
	$status 	= '1';
	$dir        = '../mumsbte/uploads/'.$code;
	
	$robots = 'robots.txt';
    $index = 'index.html';
    $contents = '<h3>Access Denied</h3>';

    $folder = array("teacher","noticeboard","notification","fees","fees/receipt","fees/upload","studentzone","exam","result","student","uploads","assignment","practical");

    if ($email=='' && $code=='' && $pwd=='') {

        $error['empty'] = '<span class="label red-alert"><font size="3">Please fill all the fileds.</font></span>';

    }else{
    
        if (!is_dir($dir)) {
    
            mkdir($dir, 0777, true);
            file_put_contents($dir.'/'.$index, $contents);
            copy('robots.txt', $dir.'/'.$robots);
    
            foreach ($folder as $generate ) {
                mkdir($dir.'/'.$generate, 0777, true);
            }
    
            foreach ($folder as $files ) {
                file_put_contents($dir.'/'.$files.'/'.$index, $contents);
                copy('robots.txt', $dir.'/'.$files.'/'.$robots);
            }
    
        }
        
        $insert = "INSERT INTO college_login (collegee_code, email, password, status) VALUES ('$code', '$email', '$npassword', '$status')";
        $run = mysqli_query($connect, $insert);
        if ($run) {
        	header("Location:smtp_mail.php?email=".$email."&pwd=".$pwd."");
        }else{
          $error['success'] = '<span class="label red-alert"><font size="3">Something Went Wrong.</font></span>';
        }

        
    }

}


?>

<!DOCTYPE html>
<html>
<head>
	<?php include 'meta.php'; ?>
</head>
<body>
	
	<?php include 'nav.php'; ?>

	<div class="container">

		<div class="row mt-5">
		    <div class="col-md-6 offset-md-3">
		      

		      <h4 class="mb-4">Register New College</h4>
		      <?php echo isset($error['success']) ? $error['success'] : '';?>
              <?php echo isset($error['empty']) ? $error['empty'] : '';?>
		      <form method="post" class="mt-2" autocomplete="off">
		        <div class="form-group">
		          <label for="code">Institute Code: (<b>DTE</b>) <span class="text-danger"><b>*</b></span></label>
		          <input type="number" class="form-control" id="code" placeholder="Eg. 5531" name="code" required minlength="4" maxlength="4" autocomplete="nope">
		          <a href="http://dtemaharashtra.gov.in/StaticPages/frmSearchInstitute.aspx" target="_blank">(DTE) Click Here To Verify Details</a>
		          <br>
		          <a href="https://online.msbte.co.in/msbte19/index.php?act=search_inst&sub=2019" target="_blank">(MSBTE) Click Here To Verify Details</a>
		        </div>
		        <div class="form-group">
		          <label for="email">Email: (<b>OFFICIAL</b>) <span class="text-danger"><b>*</b></span></label>
		          <input type="email" class="form-control" id="category" placeholder="Eg. support@bharatedu.org.in" name="email" required maxlength="50" autocomplete="nope">
		        </div>
		        <div class="form-group">
		          <label for="text">Auto Generated Password:<span class="text-danger"><b>*</b></span></label>
		          <input type="hidden" class="form-control" id="pwd" placeholder="Eg. Bharatedu@2020" name="pwd" value="<?php echo password(); ?>" required minlength="8">
		        </div> 
		        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
		      </form>

		    </div>
		</div>

	</div>


</body>
</html>
