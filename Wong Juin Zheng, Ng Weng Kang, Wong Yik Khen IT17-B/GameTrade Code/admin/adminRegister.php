<?php
session_start();
include("include/config.php");
include("adminSubmit.php");

$adminName="";
$password="";

?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>GameTrade</title>
      <link rel="stylesheet" href="css/style.css">
</head>

<body>
<form name="register" method="post" action="#" >
  <div class="vid-container">
  <div class="inner-container">
    <div class="box">
      <h1>Register</h1>
      <input type="text" name="adminName" required autocomplete="off" placeholder="Name"/>
      <input type="password" name="password" required autocomplete="off" placeholder="Password"/>

      <button type="submit" name="submit">Register</button>
    </div>
</div>
  </div>
</div>
</form>





</body>

</html>
