<?php
include("include/config.php");

session_start();

if(isset($_POST["email"]) && isset($_POST["password"])){
	$email = mysqli_real_escape_string($db,$_POST["email"]);
	$password = md5($_POST["password"]);
	$sql = "SELECT * FROM admin WHERE adminEmail = '$email' AND password = '$password'";
	$run_query = mysqli_query($db,$sql);
	$count = mysqli_num_rows($run_query);
	if($count == 1){
		$row = mysqli_fetch_array($run_query);
		$_SESSION["aid"] = $row["id"];
		$_SESSION["aname"] = $row["adminName"];

        echo "<script>alert('Login Sucessfully');</script>";
        echo "<script>window.location.assign('adminControl.php');</script>";
			exit();
		}else{
            echo "<script>alert('Invalid Admin Name or Password, please enter again.');</script>";
            echo "<script>window.location.assign('index.php');</script>";
		}
	
}

?>
