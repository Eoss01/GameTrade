<?php
include("include/db.php");  
  
session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}

if(isset($_SESSION["uid"])){
    $user_id = $_SESSION["uid"];
}

if(isset($_POST['submit'])) {
    $userId = $_POST['userId'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postcode = $_POST['postcode'];
    $state = $_POST['state'];
    $words = "/^[a-zA-Z0-9_.-]*$/";
    $number = "/^[a-zA-Z0-9_.-]*$/";


    if(empty($address) || empty($city) || empty($postcode) ||  empty($state)){
        echo "<script>alert('Please fill all field');</script>";
        echo "<script>window.location.assign('userInsertAddress.php');</script>";
        exit();
    
    }else{
    
    $sql = "SELECT address,user_id FROM address_book WHERE address = '$address' and user_id = '$userId' LIMIT 1" ;
    $check_query = mysqli_query($con,$sql);
	$count_address = mysqli_num_rows($check_query);
	if($count_address > 0){
		echo "<script>alert('Address existed');</script>";
        echo "<script>window.location.assign('userInsertAddress.php');</script>";
    
    }else{
        $sql = "INSERT INTO address_book(user_id,address,city,postcode,state) VALUES ('$userId','$address','$city','$postcode','$state')";
        $run_query = mysqli_query($con,$sql);
        echo "<script>alert('Insert Successfully');</script>";
        echo "<script>window.location.assign('addressBook.php');</script>";

    }
    
}
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>GameTrade</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/metisMenu.min.css" rel="stylesheet">

    <link href="css/timeline.css" rel="stylesheet">
    <link href="css/startmin.css" rel="stylesheet">
    <link href="css/morris.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php include("include/wheader.php"); ?>
<?php include("include/usidebar.php"); ?>
<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Address</h1>
                </div>
            </div>
            <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form name="insert" method="post" action="userInsertAddress.php" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-group">
                                            <input type="hidden" class="form-control" name="userId" value="<?php echo $user_id ?>">
                                                <label>Home Address</label>
                                                <input type="address" class="form-control" name="address" placeholder="Enter product address..">
                                            </div>
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="address" class="form-control" name="city" placeholder="Enter user city..." autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label>Postcode</label>
                                                <input type="number" class="form-control" name="postcode" placeholder="Enter user postcode..">
                                            </div>
                                            <div class="form-group">
                                                <label>State</label>
                                                <input type="address" class="form-control" name="state" placeholder="Enter user state..">
                                            </div>
                                            <button name="submit" type="submit" class="btn btn-default">Submit</button>
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