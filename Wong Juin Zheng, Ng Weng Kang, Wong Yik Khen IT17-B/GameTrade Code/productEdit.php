<?php
include("include/db.php");
session_start();
$productName = "";
$productPrice = "";
$productDiscount = "";
$productDesc = "";
$productImage = "productImage1";
$productQuantity = "";
$productStype = "";
$rentPrice = "";
$productKey = "";

if(isset($_GET['edit'])){
    $product_id = $_GET['edit'];
    $sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_bprice,a.product_desc,a.product_image,a.product_quantity,a.product_stype,a.product_rentprice,a.product_keywords,b.cat_title,c.brand_title FROM products as a left join categories as b on a.product_cat=b.cat_id left join brands as c on a.product_brand=c.brand_id WHERE product_id='$product_id'";
    $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            $a = $row['cat_title']; 
            $b = $row['brand_title'];   
            $productName = $row['product_title'];
            $productPrice = $row['product_price'];
            $productDiscount = $row['product_bprice'];
            $productDesc = $row['product_desc'];
            $productImage = $row['product_image'];
            $productQuantity = $row['product_quantity'];
            $productStype = $row['product_stype'];
            $rentPrice = $row['product_rentprice'];
            $productKey = $row['product_keywords'];
            }
        }
}
$con->close();
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
<?php include("include/ssidebar.php"); ?>
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
                                        <form name="edit" method="post" action="userViewProduct.php" enctype="multipart/form-data">
                                        <input class="form-control" id="product_id" name="product_id" type="hidden" placeholder="Enter id.." value="<?php echo $product_id; ?>" >
                                            <div class="form-group">
                                                <label>Categories ID</label>
                                                <input class="form-control" name="categoryId" value="<?php echo $a; ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Brands ID</label>
                                                <input class="form-control" name="brandId" value="<?php echo $b; ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input class="form-control" name="productName" placeholder="Enter product name.." value="<?php echo $productName; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Product Discount Price</label>
                                                <input class="form-control" name="productPrice" placeholder="Enter product price.." value="<?php echo $productPrice; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Product Original Price</label>
                                                <input class="form-control" name="productDiscount" placeholder="Enter product discount price.." value="<?php echo $productDiscount; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Product Description</label>
                                                <textarea class="form-control" rows="3" name="productDesc" placeholder="Enter product description.."><?php echo htmlspecialchars($productDesc);?></textarea>
                                            </div>
                                    
                                            <div class="form-group">
                                                <label class = "col-ms-2">Product Image</label>
                                                <div class = "col-ms-8">
                                                    <img name="productImage1" src="product_images/<?php echo $productImage; ?>" width="150px" height="150px">
                                                    <input type="text" name="productImage1" value="<?php echo $productImage; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">    
                                                <label class = "col-ms-2">Replace Product Image</label>
                                                <div class = "col-ms-8">
                                                    <input type="file" class="form-control" name="productImage" id="file" onchange="readURL(this);" />
                                                    <img id="productImage" style="width: 150px; height: 150px;">
                                                </div>
                                            </div>                                                  
                                            <div class="form-group">
                                                <label>Product Quantity</label>
                                                <input class="form-control" name="productQuantity" placeholder="Enter product quantity.." value="<?php echo $productQuantity; ?>">
                                            </div>
                                            <div class="form-group">
                                            <label>Product Sales Type</label>
                                                <select class="form-control" name="productStype" id="productStype" onchange="CheckRent(this.value);" required>
                                                <option value="">Select product sales type</option>
                                                <option value="Sales Only" <?php if($productStype=='Sales Only') { echo "selected";}?> >Sales Only</option>
                                                <option value="Sales and Rent" <?php if($productStype=='Sales and Rent') { echo "selected";}?> >Sales and Rent</option>
                                                <option value="Sales, Rent and Exchange" <?php if($productStype=='Sales, Rent and Exchange') { echo "selected";}?> >Sales, Rent and Exchange</option>
                                            </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Rent Price One Day (in $)</label>
                                                <input class="form-control" name="rentPrice" id="rentPrice" placeholder="Enter RentPrice per one day.." value="<?php echo $rentPrice; ?>" >
                                            </div>
                                            <div class="form-group">
                                                <label>Product Keyword</label>
                                                <input class="form-control" name="productKey" placeholder="Enter product keyword.." value="<?php echo $productKey; ?>">
                                            </div>
                                            <input name="edit" type="submit" class="btn btn-default" value="Save"/>
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

<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#productImage').attr('src', e.target.result);
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}

function CheckRent(val){
    var element=document.getElementById('rentPrice');
    if(val!=='Sales Only')
    element.style.display='block';
    else  
    element.style.display='none';
}
</script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/metisMenu.min.js"></script>
<script src="js/startmin.js"></script>

</body>
</html>