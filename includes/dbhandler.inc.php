<?php 

  $conn = getConnection();
  
  function getConnection(){
    $serverName = "localhost";
    $dbUserName = "root";
    $dbPWord = "";
    $dbName = "zuricrudapp";
    
    //-------------Create a server connection -----------------------
    $connServer = new mysqli($serverName, $dbUserName, $dbPWord);

    //---------------Create a Database to be used for project---------
    $sql = "CREATE DATABASE IF NOT EXISTS $dbName";
    if ($connServer->query($sql) !== TRUE) {
    echo "$dbName Did not create!"; 
    exit();
    } 
    //----------------Create Database connection for project-------------------
    $mysqli = new mysqli($serverName, $dbUserName, $dbPWord, $dbName); 
    //--------------Create users table and userscourse table--------
    $sqlQueryUsers = "CREATE TABLE IF NOT EXISTS users(
        userId INT AUTO_INCREMENT PRIMARY KEY,
        userFirstName VARCHAR(30) NOT NULL,
        userLastName VARCHAR(30) NOT NULL,
        userUid VARCHAR(30) NOT NULL,
        userEmail VARCHAR(30) NOT NULL,
        userpassword BLOB NOT NULL )";

    $sqlQueryUsersCourse = "CREATE TABLE IF NOT EXISTS usercourses(
        courseId INT AUTO_INCREMENT PRIMARY KEY,
        coursName VARCHAR(30),
        courseInstructor VARCHAR(30),
        courseDuration VARCHAR(30),
        courseUserId INT,
        FOREIGN KEY(courseUserId) REFERENCES users(userId) )"; 
        
    if ($mysqli->query($sqlQueryUsers) !== true) {
        echo '<br>'; echo 'Users Table not created';
        exit();
    } 
    
    if ($mysqli->query($sqlQueryUsersCourse) !== true) {
        echo '<br>'; echo 'Userscourse Table not created';
        exit();
    } 
    
    return $mysqli;

  }
