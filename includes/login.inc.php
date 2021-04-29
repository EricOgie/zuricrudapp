<?php

if (isset($_POST['submit'])) {

  $userName = $_POST['uName'];
  $pWord =  $_POST['pWord'];

  include_once 'testcodes.inc.php';
  include 'dbhandler.inc.php';

  if (isAnyInputEmptyLogin( $userName, $pWord) === true) {
    $_SESSION['res_type'] = "danger";
    $_SESSION['response'] = "All fields must be filled!";
      header("location: ../login.php");
      exit();
  }

  loginUserIn($conn, $userName, $pWord );


}else {
  header("location: ../login.php");
  exit();
}
