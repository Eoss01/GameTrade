<?php
include("include/config.php");
session_start();

if(!isset($_SESSION["aid"])){
	header("location:index.php");
}

if(isset($_POST['submit'])) {
	$categoryName = $_POST['categoryName'];
    $categoryDesc = $_POST['categoryDesc'];


    if(empty($categoryName) || empty($categoryDesc)){
        echo "<script>alert('Please fill all field');</script>";
        echo "<script>window.location.assign('adminICategories.php');</script>";
        exit();
    
    }else{
    
    $sql = "SELECT cat_title FROM categories WHERE cat_title = '$categoryName' LIMIT 1" ;
    $check_query = mysqli_query($db,$sql);
	$count_category = mysqli_num_rows($check_query);
	if($count_category > 0){
		echo "<script>alert('Category existed, please fill another category name');</script>";
		echo "<script>window.location.assign('adminICategories.php');</script>";
    
    }else{
        $sql = "insert into categories(cat_title,cat_desc) values ('$categoryName', '$categoryDesc')";
        $run_query = mysqli_query($db,$sql);
        echo "<script>alert('Insert Successfully');</script>";
        echo "<script>window.location.assign('adminVCategories.php');</script>";

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
                    <h1 class="page-header">Insert Category</h1>
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
                                                <label>Category Name</label>
                                                <input class="form-control" name="categoryName" placeholder="Enter category name..">
                                                </div>
                                                <div class="form-group">
                                                <label>Category Description</label>
                                                <textarea class="form-control" rows="3" name="categoryDesc" placeholder="Enter category description.."></textarea>
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
