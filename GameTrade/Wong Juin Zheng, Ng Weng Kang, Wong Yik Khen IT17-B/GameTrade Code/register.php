<?php
include("include/config.php");
include("userSubmit.php");

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
      <input type="text" name="username" required autocomplete="off" placeholder="Name"/>
      <input type="password" name="password" required autocomplete="off" placeholder="Password"/>
      <input type="password" name="repassword" required autocomplete="off" placeholder="Re-Password"/>
      <input type="email" name="email" required autocomplete="off" placeholder="Email address"/>
      <input type="text" name="contactNo" required autocomplete="off" placeholder="Contact No"/>
      <input type="text" name="address" required autocomplete="off" placeholder="Shipping address"/>
      <button type="submit" name="submit">Register</button>
      <p>Already have GameTrade account? <a href="login.php">Log In</a></p>
    </div>
</div>
  </div>
</div>
</form>





</body>

</html>
