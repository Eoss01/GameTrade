<?php
include("include/config.php");

$brandName="";
$brandDesc="";

if(isset($_GET['edit'])){
    $brandId=$_GET['edit'];
    
    $sql = "SELECT brand_id,brand_title,brand_desc FROM brands where brand_id='$brandId'";
    $result = $db->query($sql);
    
    if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
    $brandId=$row['brand_id'];   
    $brandName=$row['brand_title'];
    $brandDesc=$row['brand_desc'];
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
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Brands</h1>
                </div>
            </div>
            <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form name="insert" method="post" action="adminVBrands.php" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label>Brand Name</label>
                                                <input class="form-control" name="brandName" type="text" placeholder="Enter brand name.." value="<?php echo $brandName; ?>" >
                                                </div>
                                                <div class="form-group">
                                                <label>Brand Description</label>
                                                <textarea class="form-control" row="3" name="brandDesc" placeholder="Enter brand description.."><?php echo htmlspecialchars($brandDesc);?></textarea>
                                                </div>
                                                <input class="form-control" name="brandId" type="hidden" placeholder="Enter id name.." value="<?php echo $brandId; ?>" >
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
