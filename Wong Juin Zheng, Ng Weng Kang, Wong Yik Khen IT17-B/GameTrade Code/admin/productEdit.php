<?php
include("include/config.php");

$categoryId= "";
$brandId= "";
$productName= "";
$productPrice= "";
$productDesc= "";
$productImage1= "productImage1";
$productImage2= "productImage2";
$productImage3= "productImage3";
$productQuantity= "";
$productStype= "";
$productKey= "";

if(isset($_GET['edit'])){
    $product_id = $_GET['edit'];

    $sql = "SELECT product_id,product_cat,product_brand,product_title,product_price,product_desc,product_image1,product_image2,product_image3,product_quantity,product_stype,product_keywords FROM products WHERE product_id='$product_id'";
    $result = $db->query($sql);
    
    if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
    $product_id = $row['product_id'];        
    $categoryId = $row['product_cat'];
    $brandId = $row['product_brand'];   
    $productName = $row['product_title'];
    $productPrice = $row['product_price'];
    $productDesc = $row['product_desc'];
    $productImage1 = $row['product_image1'];
    $productImage2 = $row['product_image2'];
    $productImage3 = $row['product_image3'];
    $productQuantity = $row['product_quantity'];
    $productStype = $row['product_stype'];
    $productKey = $row['product_keywords'];
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
                                                <label>Categories</label>
                                                <select class="form-control" name="categoryId" required="required">
                                                    <option><?php echo htmlspecialchars($categoryId);?></option>
                                                    <?php
                                                        global $db;
                                                        $get_cats = "SELECT CONCAT(cat_id,' ',cat_title) AS WHOLENAME FROM categories";
                                                        $run_cats = mysqli_query($db, $get_cats);
                                                        while($row_cats = mysqli_fetch_array($run_cats)){
                                                                $CatIdTitle = $row_cats['WHOLENAME'];
                                                                echo "<option value=''>$CatIdTitle</option>";
                                                        } 
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Brands</label>
                                                <select class="form-control" name="brandId" required="required">
                                                    <option><?php echo htmlspecialchars($brandId);?></option>
                                                    <?php
                                                        global $db;
                                                        $get_cats = "SELECT CONCAT(brand_id,' ',brand_title) AS WHOLENAME1 FROM brands";
                                                        $run_cats = mysqli_query($db, $get_cats);
                                                        while($row_cats = mysqli_fetch_array($run_cats)){
                                                                $BrandIdTitle = $row_cats['WHOLENAME1'];
                                                                echo "<option value=''>$BrandIdTitle</option>";
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
                                                <label>Product Image 1</label>
                                                <input type="text" name="productImage1" value="<?php echo $productImage1; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Replace Product Image 1</label>
                                                <input type="file" class="form-control" name="productImage1" id="file" />
                                            </div>
                                            <div class="form-group">
                                                <label>Product Image 2</label>
                                                <input type="text" name="productImage2" value="<?php echo $productImage2; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Replace Product Image 2</label>
                                                <input type="file" class="form-control" name="productImage2" id="file" />
                                            </div>
                                            <div class="form-group">
                                                <label>Product Image 3</label>
                                                <input type="text" name="productImage3" value="<?php echo $productImage3; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Replace Product Image 3</label>
                                                <input type="file" class="form-control" name="productImage3" id="file" />
                                            </div>

                                            <div class="form-group">
                                                <label>Product Quantity</label>
                                                <input class="form-control" name="productQuantity" placeholder="Enter product quantity.." value="<?php echo $productQuantity; ?>">
                                            </div>
                                            <div class="form-group">
                                            <label>Product Sales Type</label>
                                                <select class="form-control" name="productStype" required="required">
                                                <option value="">Select product sales type</option>
                                                <option value="Sales Only" <?php if($productStype=='Sales Only') { echo "selected";}?> >Sales Only</option>
                                                <option value="Sales and Rent" <?php if($productStype=='Sales and Rent') { echo "selected";}?> >Sales and Rent</option>
                                                <option value="Sales, Rent and Exchange" <?php if($productStype=='Sales, Rent and Exchange') { echo "selected";}?> >Sales, Rent and Exchange</option>
                                            </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Product Keyword</label>
                                                <input class="form-control" name="productKey" placeholder="Enter product keyword.." value="<?php echo $productKey; ?>">
                                            </div>
                                            <input class="form-control" id="product_id" name="product_id" type="hidden" placeholder="Enter id.." value="<?php echo $product_id; ?>" >
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