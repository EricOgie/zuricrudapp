<?php

if (isset($_POST['submit'])) {

  $userName = $_POST['uName'];
  $pWord =  $_POST['pWord'];

  include_once 'testcodes.inc.php';
  include 'dbhandler.inc.php';

  if (isAnyInputEmptyLogin( $userName, $pWord) === true) {
      header("location: ../login.php?error=emptyinpute");
      exit();
  }

  loginUserIn($conn, $userName, $pWord );


}else {
  header("location: ../login.php");
  exit();
}
