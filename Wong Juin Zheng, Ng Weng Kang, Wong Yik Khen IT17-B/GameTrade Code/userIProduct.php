<?php
include("include/db.php");  
  
session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}

if(isset($_SESSION["uid"])){
    $user_id = $_SESSION["uid"];
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
    <script src="http://cdnjs.cloudflara.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
<?php include("include/wheader.php"); ?>
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
                                        <input class="form-control" type="hidden" name="userId" value="<?php echo $user_id?>">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Brands</label>
                                                <input class="form-control" name="productBrand" placeholder="Enter product brand..">
                                            </div>
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input class="form-control" name="productName" placeholder="Enter product name.." autocomplete="off">
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
                                                <input type="file" name="productImage" id="product_images" onchange="readURL(this);">
                                                <img id="productImage"/ style="width: 150px;height: 100px;">
                                            </div>
                                            <div class="form-group">
                                                <label>Product Quantity</label>
                                                <input class="form-control" name="productQuantity" placeholder="Enter product quantity..">
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
                $('#productImage').attr('src', e.target.result);
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