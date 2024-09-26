<?php

	//database configuration
	
	$host       = "localhost";			//host name
	$user       = "root"; 				//database username
	$pass       = "";					//database password
	$database   = "ecard";			//database name
	
	
	//$db connect variable
	$db    		= new mysqli($host, $user, $pass, $database) or die("Error : ".mysqli_error());
	$connect    = $db;
	
?>