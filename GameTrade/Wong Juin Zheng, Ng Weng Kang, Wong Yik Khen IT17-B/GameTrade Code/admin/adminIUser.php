<?php
include("include/config.php");

if(isset($_POST['submit'])){
    $username= $_POST['username'];
    $password= $_POST['password'];
    $repassword = $_POST['repassword'];
    $email= $_POST['email'];
    $contactNo= $_POST['contactNo'];
    $address= $_POST['address'];
    $usernameValidation = "/^[a-zA-Z0-9_.-]*$/";
    $number = "/^[a-zA-Z0-9_.-]*$/";


    if(empty($username) || empty($password) || empty($repassword) || empty($email) || empty($contactNo) || empty($address)){
        echo "<script>alert('Please fill all field');</script>";
        echo "<script>window.location.assign('adminIUser.php');</script>";
        exit();

    }else {
		if(!preg_match($usernameValidation,$username)){
        echo "<script>function myFunction(){alert('Please fill in a valid username(can include a-z,A-Z,0-9)');</script>";
        echo "<script>window.location.assign('adminIUser.php');</script>";
        exit();

    }
        if(strlen($password) < 8 ){
        echo "<script>alert('Please fill in a password at least 8 words(can include a-z,A-Z,0-9)');</script>";
        echo "<script>window.location.assign('adminIUser.php');</script>";
        exit();

    }
        if(strlen($repassword) < 8 ){
        echo "<script>alert('Please fill in a password at least 8 words(can include a-z,A-Z,0-9)');</script>";
        echo "<script>window.location.assign('adminIUser.php');</script>";
        exit();

    }
    if($password != $repassword){
        echo "<script>alert('Please write down same password in the re-password feild');</script>";
        echo "<script>window.location.assign('adminIUser.php');</script>";
        exit();
    }
    if(!preg_match($number,$contactNo)){
		echo "<script>alert('Please fill contact number in digits (example:0137019419)');</script>";
        echo "<script>window.location.assign('adminIUser.php');</script>";
        exit();
    }
    if(!(strlen($contactNo) == 11)){
        echo "<script>alert('Please fill contact number in 11 digits (example:0137019419)');</script>";
        echo "<script>window.location.assign('adminIUser.php');</script>";
        exit();
    
    }
    //check duplicate user
    $sql = "SELECT username FROM users WHERE username = '$username' LIMIT 1" ;
    $check_query = mysqli_query($db,$sql);
	$count_user = mysqli_num_rows($check_query);
	if($count_user > 0){
		echo "<script>alert('Username existed, please fill another username');</script>";
		echo "<script>window.location.assign('adminIUser.php');</script>";
    
    }else {
		$password = md5($password);
		$sql = "insert into users(username,password,email,contactNo,address) values ('$username', '$password', '$email', '$contactNo', '$address')";
		$run_query = mysqli_query($db,$sql);
        $_SESSION["name"] = $username;
        echo "<script>alert('Insert Succesfully');</script>";
        echo "<script>window.location.assign('adminVUser.php');</script>";
		}
}
    }

$db->close(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>GameTrade Admin Controller</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/metisMenu.min.css" rel="stylesheet">
    <link href="css/timeline.css" rel="stylesheet">
    <link href="css/startmin.css" rel="stylesheet">
    <link href="css/morris.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php include("include/header.php"); ?>
<?php include("include/sidebar.php"); ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Insert Member</h1>
                </div>
            </div>
            <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form name="insert" method="post" action="#">
                                            <div class="form-group">
                                                <label>Member Name</label>
                                                <input class="form-control" name="username" placeholder="Name">
                                                </div>
                                                <div class="form-group">
                                                <label>Member Password</label>
                                                <input class="form-control" type="password" name="password" placeholder="Password"/>
                                                </div>
                                                <div class="form-group">
                                                <label>Member Re-Password</label>
                                                <input class="form-control" type="password" name="repassword" placeholder="Re-Password"/>
                                                </div>
                                                <div class="form-group">
                                                <label>Member Email</label>
                                                <input class="form-control" name="email" placeholder="Email">
                                                </div>
                                                <div class="form-group">
                                                <label>Member Contact</label>
                                                <input class="form-control" name="contactNo" placeholder="Contact">
                                                </div>
                                                <div class="form-group">
                                                <label>Member Address</label>
                                                <input class="form-control" name="address" placeholder="Address">
                                                </div>
                                            <button name="submit" type="submit" class="btn btn-default">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/metisMenu.min.js"></script>
<script src="js/startmin.js"></script>

</body>
</html>
