<?php

session_start();

if(isset($_POST["submit"])){

  $fName = $_POST["fName"];
  $lName = $_POST["lName"];
  $userName = $_POST["uName"];
  $email = $_POST["email"];
  $pWord = $_POST["pWord"];
  $confirmPWord = $_POST["cpWord"];

 //------------------- Error Handling-------------

 require 'dbhandler.inc.php';
 require 'testcodes.inc.php';

  if (isAnyInputEmpty($fName, $lName, $userName, $email, $pWord) === true) {
      header("location: ../signup.php?error=emptyinpute");
      exit();
  }

  if (isInvalidUid($userName) === true) {
      header("location: ../signup.php?error=invaliduid");
      exit();
  }

  if (isInvalidEmail($email) === true) {
      header("location: ../signup.php?error=invalidemail");
      exit();
  }

  if (isPasswordTooshort($pWord) === true) {
      header("location: ../signup.php?error=passwordtooshort");
      exit();
  }

  if (isPasswordMisMatch($pWord, $confirmPWord ) === true) {
      header("location: ../signup.php?error=passwordmismatch");
      exit();
  }

  if (isUserExistPrior($userName, $conn, $email) !== false) {
      header("location: ../signup.php?error=takenuid");
      exit();
  }

  saveUser($conn, $fName, $lName, $userName, $email, $pWord);

}elseif (isset($_POST["reset"])) {

  $userName = $_POST["uName"];
  $pWord = $_POST["pWord"];
  $confirmPWord = $_POST["cpWord"];

  require 'dbhandler.inc.php';
  require 'testcodes.inc.php';

  if (isAnyInputEmptyReset($userName,$confirmPWord, $pWord) === true) {
    // set Some session variables for alert
    $_SESSION['res_type'] = "danger";
    $_SESSION['res-paword'] = "All fields must be filled";
      header("location: ../resetpassword.php?error=emptyinpute");
      exit();
  }

  if (isPasswordMisMatch($pWord, $confirmPWord ) === true) {
    // set Some session variables for alert
      $_SESSION['res_type'] = "danger";
      $_SESSION['res-paword'] = "Passwords does not match";
      header("location: ../resetpassword.php?error=passwordmismatch");
      exit();
  }

  if (isUserExistPrior($userName, $conn, $userName) === false) {
    // set Some session variables for alert
    $_SESSION['res_type'] = "danger";
    $_SESSION['res-paword'] = "No record of this user";
      header("location: ../resetpassword.php?error=nouser");
      exit();
  }

  resetpassword($conn, $userName, $pWord );

}else {
  header("location: ../signup.php");
  exit();
}
