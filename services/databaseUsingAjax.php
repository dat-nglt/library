<?php

$serverName = "localhost";
$userName = "root";
$passWord = "";
$database = "library";

$conn = mysqli_connect($serverName, $userName, $passWord, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}