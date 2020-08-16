<?php
include("include/config.php");

$username="";
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
<form class="container" name="login" method="POST" action="verification.php">
  <div class="vid-container">
  <div class="inner-container">
    <div class="box">
      <h1>GameTrade Login</h1>
      <input type="text" name="username" placeholder="Username"/>
      <input type="password" name="password" placeholder="Password"/>
      <button>Login</button>
      <p>Not a member? <a href="register.php">Sign Up</a></p>
    </div>
  </div>
</div>
</div>

</body>

</html>
