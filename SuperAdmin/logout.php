<?php
	session_start();	
	unset($_SESSION['admin_session']);
	unset($_SESSION['timeout']);
	session_destroy();
	header("location:login.php");
?>