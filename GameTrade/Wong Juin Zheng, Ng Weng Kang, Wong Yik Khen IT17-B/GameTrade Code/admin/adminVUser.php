<?php
include("include/config.php");

if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $email = $_POST['email'];
    $contactNo = $_POST['contactNo'];
    $address = $_POST['address'];
    $usernameValidation = "/^[a-zA-Z0-9_.-]*$/";
    $number = "/^[a-zA-Z0-9_.-]*$/";

    if(empty($username) || empty($password) || empty($repassword) || empty($email) || empty($contactNo) || empty($address)){
        echo "<script>alert('Please fill all field');</script>";
        echo "<script>window.location.assign('userEdit.php');</script>";
        exit();

    }else {
		if(!preg_match($usernameValidation,$username)){
        echo "<script>function myFunction(){alert('Please fill in a valid username(can include a-z,A-Z,0-9)');</script>";
        echo "<script>window.location.assign('userEdit.php');</script>";
        exit();

    }
        if(strlen($password) < 8 ){
        echo "<script>alert('Please fill in a password at least 8 words(can include a-z,A-Z,0-9)');</script>";
        echo "<script>window.location.assign('userEdit.php');</script>";
        exit();

    }
        if(strlen($repassword) < 8 ){
        echo "<script>alert('Please fill in a password at least 8 words(can include a-z,A-Z,0-9)');</script>";
        echo "<script>window.location.assign('userEdit.php');</script>";
        exit();

    }
    if($password != $repassword){
        echo "<script>alert('Please write down same password in the re-password feild');</script>";
        echo "<script>window.location.assign('userEdit.php');</script>";
        exit();
    }
    if(!preg_match($number,$contactNo)){
		echo "<script>alert('Please fill contact number in digits (example:0137019419)');</script>";
        echo "<script>window.location.assign('userEdit.php');</script>";
        exit();
    }
    if(!(strlen($contactNo) == 11)){
        echo "<script>alert('Please fill contact number in 11 digits (example:0137019419)');</script>";
        echo "<script>window.location.assign('userEdit.php');</script>";
        exit();
    
    }
    //check duplicate user
    $sql = "SELECT username FROM users WHERE username = '$username' LIMIT 1" ;
    $check_query = mysqli_query($db,$sql);
	$count_user = mysqli_num_rows($check_query);
	if($count_user > 0){
		echo "<script>alert('Username existed, please fill another username (example:0137019419)');</script>";
		echo "<script>window.location.assign('userEdit.php');</script>";
    
    }else {
        $md5password = md5($password);
		$sql = "UPDATE users SET username='$username', password='$md5password', email='$email', contactNo='$contactNo', address='$address' where id='$id'"; 
		$result = $db->query($sql);
        if($db->query($sql)===TRUE)
    {
        echo "<script>alert('Edit Successfully');</script>";
        
    }
    else
    {
        echo "Error: ".$sql."<br>".$db->error;
    }

}

		}
}
    
    

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="delete from users where id= '$id'";
    $result = $db->query($sql);
}


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
<script>
function ConfirmDelete(){
    return confirm("Are you sure you want to delete?");
}
</script>
<body>
<?php include("include/header.php"); ?>
<?php include("include/sidebar.php"); ?>
    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Members</h1>
                </div>
            </div>
            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <?php
                                    $results_per_page = 5;
                                    $sql = "SELECT * FROM users";
                                    $result = $db->query($sql);
                                    $number_of_results = mysqli_num_rows($result);
                                    $number_of_pages = ceil($number_of_results/$results_per_page);
                                    if (!isset($_GET['page'])) {
                                        $page = 1;
                                    } else {
                                        $page = $_GET['page'];
                                    }
                                    $this_page_first_result = ($page-1)*$results_per_page;
                                    $sql='SELECT * FROM users LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
                                    $result = mysqli_query($db, $sql);

                                    if ($result->num_rows > 0) {
                                        echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'><tr><th>ID</th><th>Name</th><th>Password</th><th>Email</th><th>ContactNo</th><th>Address</th><th>Operation</th></tr>";
                                        while($row = mysqli_fetch_array($result)) {
                                            echo "<tr>
                                            <td>" . $row["id"]. "</td>
                                            <td>" . $row["username"]. "</td>
                                            <td>" . $row["password"]."</td>
                                            <td>" . $row["email"]."</td>
                                            <td>" . $row["contactNo"]."</td>
                                            <td>" . $row["address"]."</td>
                                            <td><a href='userEdit.php?edit=".$row["id"]."'>Edit</a>  /
                                            <a href='adminVUser.php?id=".$row["id"]."' Onclick='return ConfirmDelete()'>Delete</a>"."</td></tr>";
                                        }
                                        echo "</table>";
                                    } else {
                                        echo "0 results";
                                    }
                                    for ($page=1;$page<=$number_of_pages;$page++) {
                                        echo '<ul class="pagination justify-content-center">
                                                <li class="page-item">
                                                    <a class="page-link" href="adminVUser.php?page=' . $page . '">' . $page . '</a>
                                                    </li>
                                                </ul>';
                                        }
                                        ?>
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
