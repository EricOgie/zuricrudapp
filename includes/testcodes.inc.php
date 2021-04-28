<?php

session_start();

function isAnyInputEmpty($fName, $lName, $userName, $email, $pWord){
  $result;
  if(empty($fName) || empty($lName) || empty($userName) || empty($email) || empty($pWord)){
    $result = true;
  }else {
    $result = false;
  }
  return $result;
}

function isAnyInputEmptyLogin( $userName, $pWord){
  if (empty($userName) || empty($pWord)) {
    return true;
  }else {
    return false;
  }
}

function isAnyInputEmptyReset($userName, $confirmPWord, $pWord){
  if (empty($userName) || empty($pWord) || empty($confirmPWord)) {
    return true;
  }else {
    return false;
  }
}

function isInvalidUid($userName){
  $result;
  $matchPragPram = "/^[a-zA-Z0-9]*$/";

  if (!preg_match($matchPragPram, $userName)) {
    $result = true ;
  }else {
    $result = false;
  }

  return $result;
}


function isInvalidEmail($email){
  $result;
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result = true;
  }else {
    $result = false;
  }

   return $result;
}

function isPasswordTooshort($pWord){
  $result;
  if (strlen($pWord) < 6) {
    $result = true;
  }else {
    $result = false;
  }

  return $result;
}

  function isPasswordMisMatch($pWord, $confirmPWord ){
    if($pWord === $confirmPWord ){
      return false;
    }else {
      return true;
    }
  }

/*
 * isUserExistPrior is going to serve as a two purpose function.
 * First as a normal check for pror existence in table
 * Secondly, as a method that query our user table and assign query result to $userResult
*/

function isUserExistPrior($userName, $conn, $email){
  $result;
  $sqlQuery = "SELECT * FROM users WHERE userUid = ? OR userEmail = ? ;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sqlQuery)) { // check for query statement error
    header("location: ../signup.php?error=stmterror");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $userName, $email ); // params: stmt, type of user data entered*numbers, user data passed
  mysqli_stmt_execute($stmt);
  $resultData = mysqli_stmt_get_result($stmt);

  if ($userDataArra = mysqli_fetch_assoc($resultData)) { // will return true if exitst in Database
    return $userDataArra;
  }else {
    return false;
  }

  mysqli_stmt_close($stmt); // Close connecton
}

function saveUser($conn, $fName, $lName, $userName, $email, $pWord){
  $encryptedPw = password_hash($pWord, PASSWORD_DEFAULT);
  $sql = "INSERT INTO users (userFirstName, userLastName, userUid, userEmail, userpassword)
  VALUES (?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql); // This gives an object called $stmt
  $stmt ->bind_param("sssss", $fName, $lName, $userName, $email, $encryptedPw);
  $stmt->execute();
  loginUserIn($conn, $userName, $pWord );

}

function resetpassword($conn, $userName, $pWord){
    $encryptedPw = password_hash($pWord, PASSWORD_DEFAULT); // password_hash for upping security
    $sql = "UPDATE users SET userpassword=? WHERE userUid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $encryptedPw, $userName );
    $stmt->execute();
    // set Some session variables for alert
    $_SESSION['res_type'] = "success";
    $_SESSION['res'] = "Your password has been chenged. Proceed to Sign-In";
    header("location: ../resetpassword.php?error=updated");
    exit();

}

 function loginUserIn($conn, $userName, $pWord ){

   $userDataorFalse = isUserExistPrior($userName, $conn, $userName); // return false or UserData as assoc
   // recall $sqlQuery used ^^ is conditioned to search with respect to either $email or $userName
   // so insert the user name twice as params makes senc, either one availability will work will return true.

   if ($userDataorFalse !== false ) { // check if userdata exist in DB base on either $email or $userName
    // We proceed to check for password correctness
     $pWordEncrypeted =  $userDataorFalse["userpassword"];
     if (password_verify($pWord, $pWordEncrypeted )=== true) {
       // everything is in order hence, we start a session and login user
       sendToDashBoard($userDataorFalse);
     }else {
       header("location: ../login.php?error=wrongauth");
       exit();
     }

   }else {
     header("location: ../login.php?error=nouser");
     exit();
   }
 }

  function sendToDashBoard($userData){

    $_SESSION["name"] = $userData["userFirstName"];
    $_SESSION["id"] = $userData["userId"];

    if ($_SESSION["name"] !== null) {
      header("location: ../dashboard.php");
      exit();
    }

  }
