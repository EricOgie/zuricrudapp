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
  addDefaultCourse($conn, $userName);
  $userDataorFalse = isUserExistPrior($userName, $conn, $userName);
  sendToDashBoard($userDataorFalse, $conn);
  // loginUserIn($conn, $userName, $pWord );

}

function resetpassword($conn, $userName, $pWord){
    $encryptedPw = password_hash($pWord, PASSWORD_DEFAULT); // password_hash for upping security
    $sql = "UPDATE users SET userpassword=? WHERE userUid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $encryptedPw, $userName );
    $stmt->execute();
    // set Some session variables for alert
    $_SESSION['res_type'] = "success";
    $_SESSION['res-paword'] = "Your password has been chenged. Proceed to Sign-In";
    $conn->close();
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
       sendToDashBoard($userDataorFalse, $conn);
     }else {
       $_SESSION['res_type'] = "danger";
       $_SESSION['response'] = "Incorrect username or password!";
       header("location: ../login.php");
       exit();
     }

   }else {
     $_SESSION['res_type'] = "danger";
     $_SESSION['response'] = "User Does not exit! Click SiginUp to register";
     header("location: ../login.php");
     exit();
   }
 }
 

function sendToDashBoard($userData, $conn){
    $conn->close(); // Since no more DB connection is needed, we close connection
    $_SESSION["name"] = $userData["userFirstName"];
    $_SESSION["id"] = $userData["userId"];
    if ($_SESSION["name"] !== null) {
      header("location: ../dashboard.php");
      exit();
    }

  }


function addDefaultCourse($conn, $userName){
     $DefaultCourses = ["HTML For Web Development", "Basic CSS For Web"];
     foreach ($DefaultCourses as $course) {
       $instructor = "Tomiwa Ajayi";
       $duration = "2-Months";
       $userData = isUserExistPrior($userName, $conn, $userName);
       $userId = $userData["userId"];
       $query = "INSERT INTO usercourses (coursName, courseInstructor, courseDuration, courseUserId)
       VALUES(?,?,?,?)";

       $stmtNow = $conn->prepare($query); // This gives an object called $stmt
       $stmtNow ->bind_param("sssi", $course, $instructor, $duration, $userId);
       $stmtNow->execute();
     }

 }


 function addCourse($conn, $name, $Instructor, $duration, $userId ){
   $sql = "INSERT INTO usercourses(coursName,courseInstructor,courseDuration,courseUserId)
          VALUES(?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $Instructor, $duration, $userId);
    $stmt->execute();
    $conn->close();
    header("location: ../dashboard.php");
    exit();

}

function deleteCourse($conn, $courseId){
  $sql = "DELETE FROM usercourses WHERE courseId=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $courseId);
  $stmt->execute();
  $_SESSION['res_type'] = "success";
  $_SESSION['res-add'] = "Course has been deleted from your portfolio!";
  header("location: ../dashboard.php");
  exit();

}

function editCourseDetails($conn, $courseId, $courseName, $instructor, $duration){
  $sql = "UPDATE usercourses SET coursName=?, courseInstructor=?, courseDuration=? WHERE courseId=?";
  $stmt =$conn->prepare($sql);
  $stmt->bind_param("sssi", $courseName, $instructor, $duration, $courseId);
  $stmt->execute();

  $_SESSION['res_type'] = "success";
  $_SESSION['res-add'] = "Changes made to your course have been updated!";
  header("location: ../dashboard.php");
  exit();

}
