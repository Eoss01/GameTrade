<?php

$servername = "localhost";
$username = "D170325B";
$password = "170325";
$db = "d170325b";

// Create connection
$con = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


?>