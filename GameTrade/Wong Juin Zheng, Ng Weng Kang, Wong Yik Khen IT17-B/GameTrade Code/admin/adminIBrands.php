<?php
include("include/config.php");

if(isset($_POST['submit'])) {
	$brand_title = $_POST['brandName'];
    $brand_desc = $_POST['brandDesc'];
    $words = "/^[a-zA-Z0-9_.-]*$/";

    if(empty($brand_title) || empty($brand_desc)){
        echo "<script>alert('Please fill all field');</script>";
        echo "<script>window.location.assign('adminIBrands.php');</script>";
        exit();
    
    }else{
        if(!preg_match($words,$brand_title)){
            echo "<script>alert('Please fill in a valid brand name(can include a-z,A-Z,0-9)');</script>";
            echo "<script>window.location.assign('adminIBrands.php');</script>";
            exit();
    
    }
        if(!preg_match($words,$brand_desc)){
            echo "<script>alert('Please fill in a valid brand description(can include a-z,A-Z,0-9)');</script>";
            echo "<script>window.location.assign('adminIBrands.php');</script>";
            exit();
    
    }else{
        $sql = "insert into brands(brand_title,brand_desc) values ('$brand_title', '$brand_desc')";
        $run_query = mysqli_query($db,$sql);
        echo "<script>alert('Insert Successfully');</script>";
        echo "<script>window.location.assign('adminVBrands.php');</script>";

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
                    <h1 class="page-header">Insert Brand</h1>
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
                                                <label>Brand Name</label>
                                                <input class="form-control" name="brandName" placeholder="Enter brand name..">
                                                </div>
                                                <div class="form-group">
                                                <label>Brand Description</label>
                                                <textarea class="form-control" rows="3" name="brandDesc" placeholder="Enter brand description.."></textarea>
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
