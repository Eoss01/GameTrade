<?php
include("include/config.php");

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
<form class="container" name="login" method="POST" action="adminVerification.php">
  <div class="vid-container">
  <div class="inner-container">
    <div class="box">
      <h1>Admin Login</h1>
      <input type="text" name="adminName" placeholder="Username"/>
      <input type="password" name="password" placeholder="Password"/>
      <button>Login</button>
    </div>
  </div>
</div>
</div>

</body>

</html>
