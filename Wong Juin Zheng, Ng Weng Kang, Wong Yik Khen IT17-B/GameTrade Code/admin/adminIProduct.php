<?php
  include("include/config.php");  
  session_start();
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
    <script src="http://cdnjs.cloudflara.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
                                                <label>Categories</label>
                                                <select class="form-control" name="categoryId" required="required">
                                                    <option value="">Select a Categories</option>
                                                    <?php
                                                        global $db;
                                                        $get_cats = "SELECT CONCAT(cat_id,' ',cat_title) AS WHOLENAME FROM categories";
                                                        $run_cats = mysqli_query($db, $get_cats);
                                                        while($row_cats = mysqli_fetch_array($run_cats)){
                                                                $CatIdTitle = $row_cats['WHOLENAME'];
                                                                echo "<option value='$categoryId'>$CatIdTitle</option>";
                                                        } 
                                                     ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Brands</label>
                                                <select class="form-control" name="brandId" required="required">
                                                    <option value="">Select a Brands</option>
                                                    <?php
                                                        global $db;
                                                        $get_cats = "SELECT CONCAT(brand_id,' ',brand_title) AS WHOLENAME1 FROM brands";
                                                        $run_cats = mysqli_query($db, $get_cats);
                                                        while($row_cats = mysqli_fetch_array($run_cats)){
                                                                $BrandIdTitle = $row_cats['WHOLENAME1'];
                                                                echo "<option value='$brandId'>$BrandIdTitle</option>";
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
                                                <label>Product Before Discount Price</label>
                                                <input class="form-control" name="productBPrice" placeholder="Enter product before discount price..">
                                            </div>
                                            <div class="form-group">
                                                <label>Product Description</label>
                                                <textarea class="form-control" rows="3" name="productDesc" placeholder="Enter category description.."></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Product Image 1</label>
                                                <input type="file" name="productImage1" id="product_images" onchange="readURL(this);">
                                                <img id="productImage1"/ style="width: 150px;height: 100px;">
                                            </div>
                                            <div class="form-group">
                                                <label>Product Image 2</label>
                                                <input type="file" name="productImage2" id="product_images2" onchange="readURL2(this);"> 
                                                <img id="productImage2"/ style="width: 150px;height: 100px;">
                                               
                                            </div>
                                            <div class="form-group">
                                                <label>Product Image 3</label>
                                                <input type="file" name="productImage3" id="product_images3" onchange="readURL3(this);">
                                                <img id="productImage3"/ style="width: 150px;height: 100px;">
                                                </div>
                                            <div class="form-group">
                                                <label>Product Quantity</label>
                                                <input class="form-control" name="productQuantity" placeholder="Enter product quantity..">
                                            </div>
                                            <div class="form-group">
                                                <label>Product Sales Type</label>
                                                <select class="form-control" name="productStype" required="required">
                                                <option value="">Select product sales type</option>
                                                <option value="Sales Only"  >Sales Only</option>
                                                <option value="Sales and Rent"  >Sales and Rent</option>
                                                <option value="Sales, Rent and Exchange"  >Sales, Rent and Exchange</option>
                                            </select>
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
<script>
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#productImage1').attr('src', e.target.result);
            };
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#productImage2').attr('src', e.target.result);
            };
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    function readURL3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#productImage3').attr('src', e.target.result);
            };
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/metisMenu.min.js"></script>
<script src="js/startmin.js"></script>

</body>
</html>