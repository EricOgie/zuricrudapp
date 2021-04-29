<?php

session_start();
require 'dbhandler.inc.php';
require 'testcodes.inc.php';

if(isset($_POST["submit"])){

  $fName = $_POST["fName"];
  $lName = $_POST["lName"];
  $userName = $_POST["uName"];
  $email = $_POST["email"];
  $pWord = $_POST["pWord"];
  $confirmPWord = $_POST["cpWord"];

 //------------------- Error Handling-------------

  if (isAnyInputEmpty($fName, $lName, $userName, $email, $pWord) === true) {
    $_SESSION['res_type'] = "danger";
    $_SESSION['response'] = "All fields must be filled";
      header("location: ../signup.php");
      exit();
  }

  if (isInvalidUid($userName) === true) {
    $_SESSION['res_type'] = "danger";
    $_SESSION['response'] = "Username can contain alphabets and numbers only";
      header("location: ../signup.php");
      exit();
  }

  if (isInvalidEmail($email) === true) {
    $_SESSION['res_type'] = "danger";
    $_SESSION['response'] = "Invalid email format";
      header("location: ../signup.php");
      exit();
  }

  if (isPasswordTooshort($pWord) === true) {
    $_SESSION['res_type'] = "danger";
    $_SESSION['response'] = "Error! Password should not be less than six charracters";
      header("location: ../signup.php");
      exit();
  }

  if (isPasswordMisMatch($pWord, $confirmPWord ) === true) {
    $_SESSION['res_type'] = "danger";
    $_SESSION['response'] = "Passwords does not match";
      header("location: ../signup.php");
      exit();
  }

  if (isUserExistPrior($userName, $conn, $email) !== false) {
    $_SESSION['res_type'] = "danger";
    $_SESSION['response'] = "The username/password has been taken, select another one";
      header("location: ../signup.php");
      exit();
  }

  saveUser($conn, $fName, $lName, $userName, $email, $pWord);

}elseif (isset($_POST["reset"])) {

  $userName = $_POST["uName"];
  $pWord = $_POST["pWord"];
  $confirmPWord = $_POST["cpWord"];

  if (isAnyInputEmptyReset($userName,$confirmPWord, $pWord) === true) {
    // set Some session variables for alert
    $_SESSION['res_type'] = "danger";
    $_SESSION['res-paword'] = "All fields must be filled";
      header("location: ../resetpassword.php");
      exit();
  }

  if (isPasswordMisMatch($pWord, $confirmPWord ) === true) {
    // set Some session variables for alert
      $_SESSION['res_type'] = "danger";
      $_SESSION['res-paword'] = "Passwords does not match";
      header("location: ../resetpassword.php");
      exit();
  }

  if (isUserExistPrior($userName, $conn, $userName) === false) {
    // set Some session variables for alert
    $_SESSION['res_type'] = "danger";
    $_SESSION['res-paword'] = "No record of this user";
      header("location: ../resetpassword.php");
      exit();
  }

  resetpassword($conn, $userName, $pWord );


}elseif (isset($_POST['add'])) {
    $nameCourse = $_POST['course'];
    $instructor = $_POST['instructor'];
    $duration = $_POST['duration'];
    $currentUserId = $_SESSION['id'];

    if ($nameCourse === "default" || $instructor === "default"  || $duration === "default" ) {
      $_SESSION['res_type'] = "danger";
      $_SESSION['res-add'] = "You must select item for each field";
        header("location: ../dashboard.php");
        exit();
    }

    addCourse($conn, $nameCourse, $instructor, $duration, $currentUserId );

}else {
  header("location: ../signup.php");
  exit();
}
