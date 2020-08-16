<?php
if (isset($_GET["register"])) {
	
	?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>GameTrade</title>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/main.js"></script>

		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/startmin.css" rel="stylesheet">
   	    <link href="css/font-awesome.min.css" rel="stylesheet" >
		<link href="css/font-awesome.min.css" rel="stylesheet">
	</head>
<body>
<?php include("include/fheader.php"); ?>

	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="signup_msg">
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">Customer SignUp Form</div>
					<div class="panel-body">
					
					<form id="signup_form" onsubmit="return false">

								<label for="f_name">First Name</label>
								<input type="text" id="f_name" name="f_name" class="form-control">

								<label for="l_name">Last Name</label>
								<input type="text" id="l_name" name="l_name"class="form-control">

								<label for="password">Password</label>
								<input type="password" id="password" name="password" class="form-control">

								<label for="re-password">Re-Password</label>
								<input type="password" id="repassword" name="repassword" class="form-control">

								<label for="email">Email (*Seller User Please Enter Paypal Email)</label>
								<input type="email" id="email" name="email" class="form-control">

								<label for="mobile">Mobile</label>
								<input type="tel" id="mobile" name="mobile"class="form-control">

								<label for="address">Address</label>
								<input type="address" id="address" name="address"class="form-control">
								<p><br/></p>
						<a href="forget_password.php" style="color:#333; list-style:none;">Forgotten Password</a><br>
					    <a href="login_form.php" style="color:#333; list-style:none;">Already have a GameTrade account?</a>
						<p><br/></p>
						<div class="row">
							<div class="col-md-6">
							<input style="width:100%;" value="Sign Up" type="submit" name="signup_button"class="btn btn-success btn-lg">
							</div>
							<div class="col-md-6">
								<input style="width:100%;" value="Reset" type="reset" name="reset_button"class="btn btn-success btn-lg">
							</div>
						</div>

						
					</div>
					</form>
					<div class="panel-footer"></div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</body>
</html>
	<?php
}



?>






















