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
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">Forgetten Password</div>
					<div class="panel-body">
					<?php
include("include/db.php");
	if(isset($_POST["lost_password"])){
		$email = mysqli_escape_string($con,$_POST["recovery_email"]);
		$sql = "SELECT user_id,note FROM user_info WHERE email = '$email' LIMIT 1";
		$query = mysqli_query($con,$sql);
		if(mysqli_num_rows($query) == 1){
			$row = mysqli_fetch_array($query);
			$uid = $row["user_id"];
			$note = $row["note"];
			
			if($note != ""){
				echo "Please check your email address we are already sended you password reset link";
				exit();
			}else{
				$random_note = time().rand(50000,100000);
				$random_note = str_shuffle($random_note);
				$update_note = "UPDATE user_info SET note = '$random_note' WHERE user_id='$uid' AND email='$email'";
				if(mysqli_query($con,$update_note)){
					$to = $email;
					$sub = "Reset Password";
					$msg = "Please click on the given link or copy url to rest your password: ";
					$msg .= "http://eoss01.000webhostapp.com/password_reset.php?note=".$random_note."&uid=".$uid." &email=".$email;
					$header = "From:GameTrade";
					if(mail($to,$sub,$msg,$header)){
						echo "Please confrim  your email to reset you password<br/>";
						echo "Email temporary displayed here<br/>".$msg;
						exit();
				}
				}
			

			}
		}else{
				echo "Your email adrress does not exits";
			}	
	}


	?>
					<form action="" method="post">
						<div class="row">
							<div class="col-md-12">
								<label for="email">Email</label>
								<input type="email" id="recovery_email" name="recovery_email"  class="form-control">
							</div>
						</div>	

						<p><br/></p>
						<div class="row">
							<div class="col-md-6">
							<input style="width:100%;" value="Request new password" type="submit" name="lost_password" class="btn btn-success btn-lg">
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






















