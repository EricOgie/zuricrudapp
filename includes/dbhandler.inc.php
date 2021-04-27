<?php

$serverName = "localhost";
$dbUserName = "root";
$dbPWord = "";
$dbName = "zuricrud01";

$conn = mysqli_connect($serverName, $dbUserName, $dbPWord,$dbName);

// to handle error occurance in fann_get_total_connections

if (!$conn) {
  die("Connection error odon happen. The ERROR NA: ".mysqli_connect_error());
}
