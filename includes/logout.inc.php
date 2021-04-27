<?php

session_start();
session_unset();
session_destroy();

if (count($_SESSION) === 0) {
  header("location: ../index.php");
}
