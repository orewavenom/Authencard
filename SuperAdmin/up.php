<?php 

ob_start(); 
session_start();

if(isset($_POST['imageData'])){

	$_SESSION['imgbase64'] = $_POST['imageData'];

	//echo "true";
	if (isset($_SESSION['imgbase64'])) {
		echo "session true";
	}else{
		echo "session false";
	}

	/*$image_no = rand(100000,999999);
	$_SESSION['imgbase64'] = $_POST['imageData'];
	$img = $_SESSION['imgbase64'];
	if(isset($_POST['update']){
		$update = 1;
	}else{
		$update = 0;
	}
	

	if ($update == 1) {
		$path = "images/uploads/".$image_no.".png";

		$status = file_put_contents($path,base64_decode($img));
		if($status){
		 echo "Successfully Uploaded";
		 echo $img;

		}else{
		 echo "Upload failed";
		 echo $img;
		}
	} else {
		
	}*/
	
}else{
	echo "false";
}

?>