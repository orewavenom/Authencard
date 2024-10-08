<?php
  
  ob_start(); 
  // start session
  session_start();

  // set time for session timeout
  $currentTime = time() + 25200;
  $expired = 3600;
  
  // if session not set go to login page
  if(!isset($_SESSION['admin_session'])){
    header("location:login.php");
  }
  
  // if current time is more than session timeout back to login page
  if($currentTime > $_SESSION['timeout']){
    session_destroy();
    header("location:login.php");
  }
  
  // destroy previous session timeout and create new one
  unset($_SESSION['timeout']);
  $_SESSION['timeout'] = $currentTime + $expired;
  
  
?>