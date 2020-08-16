<?php
session_start();
include("include/config.php");

	if(isset($_POST['edit']))
	{
		$username=$_POST['username'];
        $password=$_POST['password'];
        $email=$_POST['email'];
        $contactNo=$_POST['contactNo'];
        $address=$_POST['address'];
		$query=mysql_query("update users set username='$username', password='$password', email='$email', contactNo='$contactNo', address='$address' where id='".$_SESSION['id']."'");
		if($query)
		{
echo "<script>alert('Your info has been updated');</script>";
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
                                    <?php
                                        $query=mysql_query("select * from users where id='".$_SESSION['id']."'");
                                        $row = mysqli_query($db,$query);
                                        while($row=mysql_fetch_array($query)){
                                            ?>
                                        <form name="edit" method="post">
                                            <div class="form-group">
                                                <label>Member Name</label>
                                                <input class="form-control" name="username" placeholder="Enter username.." value="<?php echo $row['username'];?>"/>
                                                </div>
                                                <div class="form-group">
                                                <label>Member Password</label>
                                                <input class="form-control" type="password" name="password" placeholder="Enter password..." />
                                                </div>
                                                <div class="form-group">
                                                <label>Member Email</label>
                                                <input class="form-control" name="email" placeholder="Enter email.." value="<?php echo $_SESSION['email'] ?>">
                                                </div>
                                                <div class="form-group">
                                                <label>Member Contact</label>
                                                <input class="form-control" name="contactNo" placeholder="Enter contact No.." value="<?php echo $_SESSION['contactNo'] ?>">
                                                </div>
                                                <div class="form-group">
                                                <label>Member Address</label>
                                                <input class="form-control" name="address" placeholder="Enter address.." value="<?php echo $address; ?>">
                                                </div>
                                                <input class="form-control" name="id" type="hidden" placeholder="Enter id.." value="<?php echo $id; ?>" >
                                                <input name="edit" type="submit" class="btn btn-default" value="Edit"/>
                                            </div>
                                        </form>
                                        <?php } ?>
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
