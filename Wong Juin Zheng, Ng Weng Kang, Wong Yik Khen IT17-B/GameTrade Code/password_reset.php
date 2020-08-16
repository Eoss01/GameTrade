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
					<div class="panel-heading">Reset Password</div>
					<div class="panel-body">

					<?php

include("include/db.php");
if(isset($_REQUEST["note"]) AND isset($_REQUEST["uid"]) AND isset($_REQUEST["email"])){
    $note = preg_replace("#[^0-9]#","",$_REQUEST["note"]);
    $uid = preg_replace("#[^0-9]#","",$_REQUEST["uid"]);
    $email = mysqli_real_escape_string($con,$_REQUEST["email"]);

    $sql = "SELECT user_id FROM user_info WHERE note='$note' AND email='$email' AND user_id='$uid' LIMIT 1 ";
    $query = mysqli_query($con,$sql);
    if($query){
        ?>
					<form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $uid; ?>">
                    <input type="hidden" name="email" value="<?php echo $email; ?>">
						<div class="row">
							<div class="col-md-12">
								<label for="email">New Password :</label>
								<input type="password" name="new_password" class="form-control" required/>
							</div>
						</div>	
						<div class="row">
							<div class="col-md-12">
								<label for="email">Confirm Password : </label>
								<input type="password" name="confirm_password"  class="form-control" required/>
							</div>
						</div>
						<p><br/></p>
						<div class="row">
							<div class="col-md-6">
							<input style="width:100%;" value="Reset Password" type="submit" name="change_password" class="btn btn-success btn-lg">
							</div>
							<div class="col-md-6">
								<input style="width:100%;" value="Reset" type="reset" name="reset_button"class="btn btn-success btn-lg">
							</div>
						</div>	
					</div>
					</form>
        <?php
    }else{
    echo "Error : Please try again...";
        }
    }
        ?>
				
        
        

<?php
if(isset($_POST["change_password"])){
    $n_pass = $_POST["new_password"];
    $c_pass = $_POST["confirm_password"];
    $id = $_POST["id"];
	$email = $_POST["email"];
	
	if(strlen($n_pass) < 9 ){
		echo "Password length is too short.";
	}else{
		if($n_pass == $c_pass){
			$password = md5($n_pass);
			$change_pass_sql = "UPDATE user_info set password = '$password', note='' WHERE user_id='$id' AND email='$email'";
			$query = mysqli_query($con,$change_pass_sql);
			if($query){
				echo "Your password is reset, now you can login.";
			}
		}else{
			echo "Both password are not same.";
		}
	}


        }
?>
					<div class="panel-footer"></div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</body>
</html>