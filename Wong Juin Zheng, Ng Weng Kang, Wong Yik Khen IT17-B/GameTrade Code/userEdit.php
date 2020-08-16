<?php
session_start();
include("include/db.php");

if(!isset($_SESSION["uid"])){
    header("location:index.php"); 
}

if(isset($_POST['edit'])){
    $f_name = $_POST['firstname'];
    $l_name = $_POST['lastname'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$address = $_POST['address'];
	$name = "/^[a-zA-Z ]+$/";
	$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
	$number = "/^[0-9]+$/";

if(empty($f_name) || empty($l_name) || empty($email) || empty($password) || empty($repassword) ||
	empty($mobile)|| empty($address)){
		
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>PLease Fill all fields..!</b>
			</div>
		";
		exit();
	} else {
		if(!preg_match($name,$f_name)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $f_name is not valid..!</b>
			</div>
		";
		exit();
	}
	if(!preg_match($name,$l_name)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $l_name is not valid..!</b>
			</div>
		";
		exit();
	}
	if(!preg_match($emailValidation,$email)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>this $email is not valid..!</b>
			</div>
		";
		exit();
	}
	if(strlen($password) < 9 ){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Password is weak</b>
			</div>
		";
		exit();
	}
	if(strlen($repassword) < 9 ){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Password is weak</b>
			</div>
		";
		exit();
	}
	if($password != $repassword){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>password is not same</b>
			</div>
		";
	}
	if(!preg_match($number,$mobile)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Mobile number $mobile is not valid</b>
			</div>
		";
		exit();
	}
	if(!(strlen($mobile) == 10)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Mobile number must be 10 digit</b>
			</div>
		";
		exit();     
	}else {
        $user_id = $_SESSION["uid"];
        $md5password = md5($password);
		$sql = "UPDATE user_info SET first_name='$f_name', last_name='$l_name', password='$md5password', email='$email', mobile='$mobile', address='$address' where user_id='$user_id'"; 
		$result = $con->query($sql);
        if($con->query($sql)===TRUE)
    {
        echo "<script>alert('Edit Successfully');</script>";
    }
    else
    {
        echo "Error: ".$sql."<br>".$con->error;
    }

}

		}
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>GameTrade</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/metisMenu.min.css" rel="stylesheet">

    <link href="css/timeline.css" rel="stylesheet">
    <link href="css/startmin.css" rel="stylesheet">
    <link href="css/morris.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<style>
	
		table tr td {padding:10px;}
		</style>
</head>

<body>
<?php include("include/wheader.php"); ?>
	<?php include("include/usidebar.php"); ?>
	<p><br /></p>
	<p><br /></p>
	<p><br /></p>
	<div class="container-fluid">

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-body">
						<h1>Edit User Information</h1>
						<hr />
						<div class="col-md-8" id="signup_msg">
						</div>
						<?php
                            include_once("include/db.php");
                            
							$user_id = $_SESSION["uid"];
							$user_list = "SELECT * FROM user_info WHERE user_id='$user_id'";
							$query = mysqli_query($con,$user_list);
							if (mysqli_num_rows($query) > 0) {
								while ($row=mysqli_fetch_array($query)) {
									?>
						<div class="row">
							<div class="col-md-6">
								<table>
									<form name="edit" method="post" enctype="multipart/form-data">
										<tr>
											<td>First Name:</td>
											<td><b><input type="text" class="form-control" name="firstname" placeholder="Enter firstname.." value="<?php echo $row["first_name"]; ?>"></b> </td>
										</tr>
										<tr>
											<td>Last Name:</td>
											<td><b><input type="text" class="form-control" name="lastname" placeholder="Enter lastname.." value="<?php echo $row["last_name"]; ?>"></b></td>
										</tr>
										<tr>
											<td>Email:</td>
											<td><b><input type="email" class="form-control" name="email" placeholder="Enter email.." value="<?php echo $row["email"]; ?>"></b></td>
										</tr>
										<tr>
											<td>Password:</td>
											<td><b><input type="password" class="form-control" name="password" placeholder="Enter password.." value=""></b></td>
										</tr>
										<tr>
											<td>Re-Password:</td>
											<td><b><input type="password" class="form-control" name="repassword" placeholder="Enter re-password.." value=""></b></td>
										</tr>
										<tr>
											<td>Mobile:</td>
											<td><b><input type="text" class="form-control" name="mobile" placeholder="Enter mobile.." value="<?php echo $row["mobile"]; ?>"></b></td>
										</tr>
										<tr>
											<td>Address:</td>
											<td><b><input type="address" class="form-control" name="address" placeholder="Enter address.." value="<?php echo $row["address"]; ?>"></b></td>
										</tr>
										<tr>
											<td><input name="edit" type="submit" class="btn btn-default" value="Save" /></td>
											<td><b>
											</tr>
									</form>
								</table>
							</div>
							<div>
								<?php
								}
							}
						?>

							</div>
						</div>
					</div>
					<div class="col-md-2"></div>
				</div>
			</div>
			<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/metisMenu.min.js"></script>
<script src="js/startmin.js"></script>
</body>

</html>