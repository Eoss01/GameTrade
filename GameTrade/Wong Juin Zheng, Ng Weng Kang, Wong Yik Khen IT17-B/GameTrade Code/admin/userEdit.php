<?php
include("include/config.php");

$username="";
$password="";
$email="";
$contactNo="";
$address="";

if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    
    $sql = "SELECT username,password,email,contactNo,address FROM users where id='$id'";
    $result = $db->query($sql);
    
    if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) { 
    $username=$row['username'];
    $password=$row['password'];
    $email=$row['email'];
    $contactNo=$row['contactNo'];
    $address=$row['address'];
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
                    <h1 class="page-header">Edit Member</h1>
                </div>
            </div>
            <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form name="edit" method="post" action="adminVUser.php" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label>Member Name</label>
                                                <input class="form-control" name="username" placeholder="Enter username.." value="<?php echo $username; ?>">
                                                </div>
                                                <div class="form-group">
                                                <label>Member Password</label>
                                                <input class="form-control" type="password" name="password" placeholder="Enter password..." />
                                                </div>
                                                <div class="form-group">
                                                <label>Member Re-Password</label>
                                                <input class="form-control" type="password" name="repassword" placeholder="Enter re-password....."/>
                                                </div>
                                                <div class="form-group">
                                                <label>Member Email</label>
                                                <input class="form-control" name="email" placeholder="Enter email.." value="<?php echo $email; ?>">
                                                </div>
                                                <div class="form-group">
                                                <label>Member Contact</label>
                                                <input class="form-control" name="contactNo" placeholder="Enter contact No.." value="<?php echo $contactNo; ?>">
                                                </div>
                                                <div class="form-group">
                                                <label>Member Address</label>
                                                <input class="form-control" name="address" placeholder="Enter address.." value="<?php echo $address; ?>">
                                                </div>
                                                <input class="form-control" name="id" type="hidden" placeholder="Enter id.." value="<?php echo $id; ?>" >
                                                <input name="edit" type="submit" class="btn btn-default" value="Edit"/>
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
