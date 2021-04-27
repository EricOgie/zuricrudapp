<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Crud Assignment</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <p class="navbar-brand">EricCrud</p>
      </div>
        <ul class="nav navbar-nav navbar-right">
          <!-- 6 -->

          <li id="home"><a href="index.php">HOME</a></li>
          <?php
             if (count($_SESSION) !== 0) {
              echo '<li id="contact"><a href="includes/mystudy.php">MY STUDY</a></li>';
              echo '<li id="contact"><a href="includes/logout.inc.php">LOG OUT</a></li>';

            }else {
              echo '<li id="contact"><a href="signup.php">SIGN UP</a></li>';
              echo '<li id="contact"><a href="login.php">LOG IN</a></li>';
            }
           ?>

        </ul>
    </div>
  </nav>

  <body>
    <div class="container">
