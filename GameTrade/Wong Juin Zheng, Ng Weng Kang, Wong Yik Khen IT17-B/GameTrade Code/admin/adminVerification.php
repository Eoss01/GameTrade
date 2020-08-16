<?php
session_start();
include("include/config.php");

$a=$_POST["adminName"]; 
$p=md5($_POST["password"]);
$adminNameValidation = "/^[a-zA-Z0-9_.-]*$/";

if(empty($a) || empty($p)){
    echo "<script>alert('Please fill all field');</script>";
    echo "<script>window.location.assign('adminLogin.php');</script>";
    exit();

}else{
    if(!preg_match($adminNameValidation,$a)){
        echo "<script>alert('Please fill in a valid adminName(can include a-z,A-Z,0-9)');</script>";
        echo "<script>window.location.assign('adminLogin.php');</script>";
        exit();

}else{
    $sql = "select * from admin where adminName = '$a' and password = '$p'";
    $result = $db->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $_SESSION["adminName"] = $a; //assign the username to session value
    
            echo "<script>window.location.assign('adminControl.php');</script>";
        
        }
    } else{ 
        echo "<script>alert('Invalid Admin Name or Password, please enter again.');</script>";
        echo "<script>window.location.assign('adminlogin.php');</script>";
    }
}
}

$db->close();

?>
