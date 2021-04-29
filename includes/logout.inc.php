<?php

session_start();
session_unset();
// session_destroy();
$_SESSION['isUserLoggedIn'] = 0;
header("location: ../index.php");
exit();
