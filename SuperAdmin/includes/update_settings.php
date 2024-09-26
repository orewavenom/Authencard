<?php

// start session
include 'session.php';
include 'connect_database.php';


if(isset($_POST["em"]) && isset($_POST["op"]) && isset($_POST["np"]) && isset($_POST["cp"]) ){

	$em 		= mysqli_escape_string($db, $_POST["em"]);
 	$op 		= mysqli_escape_string($db, $_POST["op"]);
 	$np 		= mysqli_escape_string($db, $_POST["np"]);
 	$cp 		= mysqli_escape_string($db, $_POST["cp"]);

	$oldpassword = md5($op);
    $result = mysqli_query($db, "SELECT id FROM administrator WHERE password='$oldpassword' ");
    $row = mysqli_num_rows($result);

    if ($row=='1') {
              
	    if ($np == $cp) {

	    	$new_password = md5($np);
	    	$update = " UPDATE administrator SET password='$new_password', email='$em' WHERE id='1' ";
	    	$run = mysqli_query($db, $update);
	    	if ($run) {
	      		echo "success";
	    	}else{
	      		echo "failed";
	    	}

	    }else{
	        echo "not_match";
	    }

    }else{
    	echo "incorrect";
    }
 	
}else{
	echo "error";
}

?>