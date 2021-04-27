<?php

if(isset($_POST["submit"])){

  $fName = $_POST["fName"];
  $lName = $_POST["lName"];
  $userName = $_POST["uName"];
  $email = $_POST["email"];
  $pWord = $_POST["pWord"];
  $confirmPWord = $_POST["cpWord"];

 //------------------- Error Handling-------------

 require_once 'dbhandler.inc.php';
 require_once 'testcodes.inc.php';

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

  if (isUserExistPrior($userName, $conn, $email) === true) {
      header("location: ../signup.php?error=takenuid");
      exit();
  }


  createUser($conn, $fName, $lName, $userName, $email, $pWord);

}else {
  header("location: ../signup.php");
  exit();
}

if(isset($_POST["reset"])) {

  $userName = $_POST["uName"];
  $pWord = $_POST["pWord"];
  $confirmPWord = $_POST["cpWord"];

  if (isAnyInputEmptyReset($userName,$confirmPWord, $pWord) === true) {
      header("location: ../resetpassword.php?error=emptyinpute");
      exit();
  }

  if (isPasswordMisMatch($pWord, $confirmPWord ) === true) {
      header("location: ../resetpassword.php?error=passwordmismatch");
      exit();
  }

  if (isUserExistPrior($userName, $conn, $email) === false) {
      header("location: ../resetpassword.php?error=nouser");
      exit();
  }

  resetpassword($conn, $userName, $pWord );

}
