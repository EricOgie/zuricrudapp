<?php

session_start();
unset($_SESSION["name"]);
unset($_SESSION["id"]);
// session_unset();
header("location: ../index.php");
exit();

