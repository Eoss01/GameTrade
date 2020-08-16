<?php
$servername = "localhost";
$username = "D170325B";
$password = "170325";
$db = "d170325b";

// Create connection
$db = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
?>