<?php
include("include/config.php");
if(isset($_SESSION["aid"])){
	header("location:adminControl.php");
}
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
			<input type="email" class="form-control" name="email" id="email" placeholder="Username" required/>
			<input type="password" class="form-control" name="password" id="password" placeholder="Password" required/>
      <button>Login</button>
    </div>
  </div>
</div>
</div>

</body>

</html>
