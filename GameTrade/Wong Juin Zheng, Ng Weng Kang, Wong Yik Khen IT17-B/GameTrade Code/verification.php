<?php
session_start();
include("include/config.php");

$u=$_POST['username']; 
$p=md5($_POST['password']); 
$usernameValidation = "/^[a-zA-Z0-9_.-]*$/";

if(empty($u) || empty($p)){
    echo "<script>alert('Please fill all field');</script>";
    echo "<script>window.location.assign('login.php');</script>";
    exit();

}else{
    if(!preg_match($usernameValidation,$u)){
        echo "<script>alert('Please fill in a valid username(can include a-z,A-Z,0-9)');</script>";
        echo "<script>window.location.assign('login.php');</script>";
        exit();

}

    if(strlen($p) < 8 ){
    echo "<script>alert('Please fill in a password at least 8 words(can include a-z,A-Z,0-9)');</script>";
    echo "<script>window.location.assign('login.php');</script>";
    exit();

    }else{
        $sql = "select * from users where username = '$u' and password = '$p'";
        $result = $db->query($sql);        

    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $_SESSION['user'] = $u; //assign the username to session value

        echo "<script>window.location.assign('main.php?#');</script>";
    
    }
} else{ 
    echo "<script>alert('Invalid username or password, please enter again.');</script>";
    echo "<script>window.location.assign('login.php');</script>";
}
    }

}


$db->close();

?>
