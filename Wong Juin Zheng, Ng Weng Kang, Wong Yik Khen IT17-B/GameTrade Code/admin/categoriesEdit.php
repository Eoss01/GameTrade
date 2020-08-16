<?php
include("include/config.php");
session_start();

$categoryName="";
$categoryDesc="";

if(isset($_GET['edit'])){
    $categoryId=$_GET['edit'];
    
    $sql = "SELECT cat_id,cat_title,cat_desc FROM categories where cat_id='$categoryId'";
    $result = $db->query($sql);
    
    if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
    $categoryId=$row['cat_id'];   
    $categoryName=$row['cat_title'];
    $categoryDesc=$row['cat_desc'];
    }
    }
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
<body>
<?php include("include/header.php"); ?>
<?php include("include/sidebar.php"); ?>
    <div id="page-wrapper">
        <div class="container-fluid">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Category</h1>
                </div>
            </div>
            <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form name="form1" method="post" action="adminVCategories.php" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label>Category Name</label>
                                                <input class="form-control" name="categoryName" type="text" placeholder="Enter category name.." value="<?php echo $categoryName; ?>" >
                                                </div>
                                                <div class="form-group">
                                                <label>Category Description</label>
                                                <textarea class="form-control" row="3" name="categoryDesc" placeholder="Enter category description.."><?php echo htmlspecialchars($categoryDesc);?></textarea>
                                                </div>
                                                <input class="form-control" name="categoryId" type="hidden" placeholder="Enter category id.." value="<?php echo $categoryId; ?>" >
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