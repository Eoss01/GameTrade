<?php
include("include/config.php");

if(isset($_POST['submit'])){
    $adminName= $_POST['adminName'];
    $password= md5($_POST['password']);

	$sql = "insert into admin(adminName,password) values ('$adminName', '$password')";
    $result = $db->query($sql);
    header('Location: adminLogin.php');
}
$db->close();  
?>