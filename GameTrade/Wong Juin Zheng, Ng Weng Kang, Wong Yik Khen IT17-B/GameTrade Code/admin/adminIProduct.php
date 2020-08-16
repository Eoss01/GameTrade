<?php
  include("include/config.php");  
  
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
                    <h1 class="page-header">Insert Product</h1>
                </div>
            </div>
            <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form name="insert" method="post" action="insertP.php" enctype="multipart/form-data">
                                        <div class="form-group">
                                                <label>Categories ID</label>
                                                <select class="form-control" name="categoryId" required="required">
                                                    <option>Select a Categories</option>
                                                <?php
                                                    global $db;
                                                    $get_cats = "select * from categories";
                                                    $run_cats = mysqli_query($db, $get_cats);
                                                    while($row_cats = mysqli_fetch_array($run_cats)){
                                                            $categoryId = $row_cats['cat_id'];
                                                            $categoryName = $row_cats['cat_title'];
                                                            echo "<option value='$categoryId'>$categoryName</option>";
                                                     } 
                                                 ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Brands ID</label>
                                                <select class="form-control" name="brandId" required="required">
                                                    <option>Select a Brands</option>
                                                <?php
                                                    global $db;
                                                    $get_cats = "select * from brands";
                                                    $run_cats = mysqli_query($db, $get_cats);
                                                    while($row_cats = mysqli_fetch_array($run_cats)){
                                                            $brandId = $row_cats['brand_id'];
                                                            $brandName = $row_cats['brand_title'];
                                                            echo "<option value='$brandId'>$brandName</option>";
                                                     } 
                                                 ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input class="form-control" name="productName" placeholder="Enter product name..">
                                            </div>
                                            <div class="form-group">
                                                <label>Product Price</label>
                                                <input class="form-control" name="productPrice" placeholder="Enter product price..">
                                            </div>
                                            <div class="form-group">
                                                <label>Product Description</label>
                                                <textarea class="form-control" rows="3" name="productDesc" placeholder="Enter category description.."></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Product Image</label>
                                                <input type="file" name="productImage">
                                            </div>
                                            <div class="form-group">
                                                <label>Product Keyword</label>
                                                <input class="form-control" name="productKey" placeholder="Enter product keyword..">
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