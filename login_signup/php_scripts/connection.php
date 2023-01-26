<?php

$serverName = "localhost";
$dbUsername = "georgia";
$dbPassword = "bHAreNszkCISspyfqrSamkOtgkzVldah";
$dbName = "Eduzone";

// $conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);
// if (!conn) {
//     die("connection failed: " . mysqli_connect_error());

// }
$connection = new mysqli("$serverName", "$dbUsername", "$dbPassword", "$dbName");
?>