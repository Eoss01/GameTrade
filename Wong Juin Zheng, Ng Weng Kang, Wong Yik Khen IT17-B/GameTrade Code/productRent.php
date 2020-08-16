<?php
include("include/db.php");  
  
session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}

if(isset($_SESSION["uid"])){
    $user_id = $_SESSION["uid"];
}

if(isset($_GET['selectedRentProduct'])){
    $rent = $_GET['selectedRentProduct'];

    $sql = "SELECT * FROM products WHERE product_id='$rent'";
    $run_query = mysqli_query($con,$sql);
    
    $getProdInfo = mysqli_fetch_array($run_query);
    $product_id =$getProdInfo["product_id"];
    $renter_id =$getProdInfo["user_id"];
    $product_brand =$getProdInfo["product_brand"];
    $product_title = $getProdInfo["product_title"];
    $product_price = $getProdInfo['product_price'];
    $product_desc = $getProdInfo['product_desc'];
    $product_image = $getProdInfo["product_image"];
    $product_quantity = $getProdInfo["product_quantity"];
    $product_rentPrice = $getProdInfo["product_rentprice"];
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

<script type="text/javascript">
    function GetProPerQty(){
        var rentqty = document.getElementById("qty").value;
        var rprice = document.getElementById("rentPrice").value;
        var qtyperprice = rprice * rentqty;
        return qtyperprice;
    }

    function calRentPerQty(){
        if(document.getElementById("qty")){
            document.getElementById("rentPrice").value=GetProPerQty();
        }  
    }  

    function GetDays(){ 
        var dropdt = new Date(document.getElementById("drop_date").value);
        var pickdt = new Date(document.getElementById("pick_date").value);
        var rprice1 = document.getElementById("rentPrice").value;
        var result = parseInt((dropdt - pickdt) / (24 * 3600 * 1000) * rprice1);
        return result;
    }

    function calTotal(){
        if(document.getElementById("drop_date")){
            document.getElementById("total").value=GetDays();
        }  
    }

    $( "selector" ).datepicker({
        dateFormat: "dd-mm-yyyy"
    });
</script>
</head>
<body>
<?php include("include/wheader.php"); ?>
<?php include("include/rsidebar.php"); ?>
<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Insert Rent Time</h1>
                </div>
            </div>
            <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                <div style="width:600px;">
                                    <div class="col-lg-6">
                                        <form name="insert" method="post" action="insertRent.php" enctype="multipart/form-data">
                                        <div class="form-group">
                                        <input class="form-control" type="hidden" name="productId" value="<?php echo $product_id?>">
                                        <input class="form-control" type="hidden" name="renterId" value="<?php echo $renter_id?>">

                                            <div class="form-group">
                                                <label>Proudct Name</label>
                                                <input class="form-control" name="productName" value="<?php echo $product_title?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Product Qty</label>
                                                <input class="form-control" name="quantity" id="quantity" value="<?php echo $product_quantity?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Rent Product Quantity</label>
                                                <input class="form-control" name="qty" id="qty" onchange="calRentPerQty()">
                                            </div>
                                            <div class="form-group">
                                                <label>One Day Price(in $)</label>
                                                <input class="form-control" name="rentPrice" id="rentPrice" value="<?php echo $product_rentPrice?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Start Date</label>
                                                <input type="date" autocomplete="off" name="pick_date" id="pick_date" onchange="calTotal()" class="form-control datepicker" required>
                                            </div>
                                            <div class="form-group">
                                                <label>End Date</label>
                                                <input type="date" autocomplete="off" name="drop_date" id="drop_date" onchange="calTotal()" class="form-control datepicker" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Total Price</label>
                                                <input class="form-control" name="total" id="total" readonly>
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