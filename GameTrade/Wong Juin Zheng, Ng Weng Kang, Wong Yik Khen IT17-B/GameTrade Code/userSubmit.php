<?php
session_start();
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
        echo "<script>window.location.assign('register.php');</script>";
        exit();

    }else {
		if(!preg_match($usernameValidation,$username)){
        echo "<script>alert('Please fill in a valid username(can include a-z,A-Z,0-9)');</script>";
        echo "<script>window.location.assign('register.php');</script>";
        exit();

    }
        if(strlen($password) < 8 ){
        echo "<script>alert('Please fill in a password at least 8 words(can include a-z,A-Z,0-9)');</script>";
        echo "<script>window.location.assign('register.php');</script>";
        exit();

    }
        if(strlen($repassword) < 8 ){
        echo "<script>alert('Please fill in a password at least 8 words(can include a-z,A-Z,0-9)');</script>";
        echo "<script>window.location.assign('register.php');</script>";
        exit();

    }
    if($password != $repassword){
        echo "<script>alert('Please write down same password in the re-password feild');</script>";
        echo "<script>window.location.assign('register.php');</script>";
        exit();
    }
    if(!preg_match($number,$contactNo)){
        echo "<script>alert('Please fill contact number in digits (example:0137019419)');</script>";
        echo "<script>window.location.assign('register.php');</script>";
        exit();
		
    }
    if(!(strlen($contactNo) == 11)){
        echo "<script>alert('Please fill contact number in 11 digits (example:0137019419)');</script>";
        echo "<script>window.location.assign('register.php');</script>";
        exit();
    
    }
    //check duplicate user
    $sql = "SELECT username FROM users WHERE username = '$username' LIMIT 1" ;
    $check_query = mysqli_query($db,$sql);
	$count_user = mysqli_num_rows($check_query);
	if($count_user > 0){
		echo "<script>alert('Username existed, please fill another username (example:0137019419)');</script>";
		echo "<script>window.location.assign('register.php');</script>";
    
    }else {
		$password = md5($password);
		$sql = "insert into users(username,password,email,contactNo,address) values ('$username', '$password', '$email', '$contactNo', '$address')";
		$run_query = mysqli_query($db,$sql);
        $_SESSION["name"] = $username;
        $_SESSION["password"] = $password;
        $_SESSION["email"] = $email;
        $_SESSION["contactNo"] = $contactNo;
        $_SESSION["address"] = $address;
        header('Location: login.php');
		}
}
    }

$db->close();  
?>