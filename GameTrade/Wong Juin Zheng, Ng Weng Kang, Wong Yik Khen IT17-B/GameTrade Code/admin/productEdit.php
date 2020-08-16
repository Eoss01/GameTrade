<?php
include("include/config.php");

$categoryId= "";
$brandId= "";
$productName= "";
$productPrice= "";
$productDesc= "";
$productImage= "";
$productKey= "";

if(isset($_GET['edit'])){
    $product_id=$_GET['edit'];
    
    $sql = "SELECT product_id,product_cat,product_brand,product_title,product_price,product_desc,product_image,product_keywords FROM products where product_id='$product_id'";
    $result = $db->query($sql);
    
    if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
    $productId=$row['product_id'];
    $categoryId=$row['product_cat'];
    $brandId=$row['product_brand'];   
    $productName=$row['product_title'];
    $productPrice=$row['product_price'];
    $productDesc=$row['product_desc'];
    $productImage=$row['product_image'];
    $productKey=$row['product_keywords'];
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
                    <h1 class="page-header">Edit Product</h1>
                </div>
            </div>
            <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form name="edit" method="post" action="adminVProduct.php" enctype="multipart/form-data">
                                        <div class="form-group">
                                                <label>Categories ID</label>
                                                <select class="form-control" name="categoryId" required="required">
                                                    <option><?php echo htmlspecialchars($categoryId);?></option>
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
                                                    <option><?php echo htmlspecialchars($brandId);?></option>
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
                                                <input class="form-control" name="productName" placeholder="Enter product name.." value="<?php echo $productName; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Product Price</label>
                                                <input class="form-control" name="productPrice" placeholder="Enter product price.." value="<?php echo $productPrice; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Product Description</label>
                                                <textarea class="form-control" rows="3" name="productDesc" placeholder="Enter product description.."><?php echo htmlspecialchars($productDesc);?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Product Image</label>
                                                <input type="file" name="productImage">
                                            </div>
                                            <div class="form-group">
                                                <label>Product Keyword</label>
                                                <input class="form-control" name="productKey" placeholder="Enter product keyword.." value="<?php echo $productKey; ?>">
                                            </div>
                                            <input class="form-control" name="product_id" type="hidden" placeholder="Enter id.." value="<?php echo $productId; ?>" >
                                            <input name="edit" type="submit" class="btn btn-default" value="Edit"/>
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
