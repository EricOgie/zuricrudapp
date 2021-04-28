<?php

$serverName = "localhost";
$dbUserName = "root";
$dbPWord = "";
$dbName = "zuricrud01";

// Create connection
$conn = new mysqli($serverName, $dbUserName, $dbPWord,$dbName);

// to handle error occurance in fann_get_total_connections
if ($conn->connect_error) {
  die("Connection error don happen. Error na: " . $conn->connect_error);
}
