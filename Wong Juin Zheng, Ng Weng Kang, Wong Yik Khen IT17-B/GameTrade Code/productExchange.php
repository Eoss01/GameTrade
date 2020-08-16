<?php
include("include/db.php");
session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}

if(isset($_SESSION["uid"])){
    $user_id = $_SESSION["uid"];
}


$exchange = '';
if(isset($_GET['exchange'])){
    $exchange = $_GET['exchange'];
    $_SESSION['exchange1'] = $_GET['exchange'];

    $qry="SELECT * FROM products WHERE product_id='$exchange'";
    $result1 = $con->query($qry);
}


if(isset($_GET['selectedProduct'])){
    $a = $_GET['selectedProduct'];
    $exchange = $_SESSION['exchange1'];

    $sql1 = "SELECT * FROM products WHERE product_id = '$exchange'";
    $run_query1 = mysqli_query($con,$sql1);
    $getProdInfo = mysqli_fetch_array($run_query1);
    $product_id =$getProdInfo['product_id'];
    $product_brand =$getProdInfo['product_brand'];
    $product_title = $getProdInfo["product_title"];
    $product_price = $getProdInfo['product_price'];
    $product_desc = $getProdInfo['product_desc'];
    $product_image = $getProdInfo['product_image'];
    $product_quantity = $getProdInfo['product_quantity'];

    $sql2 = "SELECT * FROM products WHERE product_id='$a' ";
    $run_query2 = mysqli_query($con,$sql2);
    $getProdInfo = mysqli_fetch_array($run_query2);
    $exchanger =$getProdInfo["user_id"];
    $eproduct_id =$getProdInfo["product_id"];
    $eproduct_brand =$getProdInfo["product_brand"];
    $eproduct_title = $getProdInfo["product_title"];
    $eproduct_price = $getProdInfo['product_price'];
    $eproduct_desc = $getProdInfo['product_desc'];
    $eproduct_image = $getProdInfo["product_image"];
    $eproduct_quantity = $getProdInfo["product_quantity"];

    $sql3 = "INSERT INTO `exchange_request`(`user_id`,`exchanger_id`, `product_id`, `product_title`, `product_image`, `eproduct_id`, `eproduct_title`, `eproduct_image`, `status_detail`) VALUES ('$user_id', '$exchanger', '$product_id', '$product_title', '$product_image', '$eproduct_id', '$eproduct_title', '$eproduct_image','1')";
    
    $sql= $sql1.";".$sql2.";".$sql3.";";
          
    $result = mysqli_multi_query($con,$sql);

    if($result) {
        //echo "<script>alert($a);</script>";
        //echo "<script>alert($exchange);</script>";
        //echo "Error: " . $sql4 . "<br>" . mysqli_error($con);
        echo "<script>alert('Exchange Successful');</script>";
        echo "<script>window.location.assign('userExchangeControl.php');</script>";
    }
    else
    {
        echo "<script>alert('Exchange Failed');</script>";
        echo "<script>window.location.assign('productExchange.php');</script>";
    }
    
}

//pagination
$num_rec_per_page=2;
if(isset($_GET['pg']))
{
    $pg=$_GET['pg'];
    $exchange = $_SESSION['exchange1'];

}
else
{
    $pg=1;
}
$startfrom=( $pg-1 ) * $num_rec_per_page; 
$qry1="SELECT a.product_id,a.product_title,a.product_price,a.product_bprice,a.product_desc,a.product_image,a.product_quantity,a.product_stype,a.product_keywords,b.cat_title,c.brand_title FROM products as a left join categories as b on a.product_cat=b.cat_id left join brands as c on a.product_brand=c.brand_id WHERE product_id='$exchange'";
$result1 = $con->query($qry1);
$qry="SELECT a.product_id,a.product_title,a.product_price,a.product_bprice,a.product_desc,a.product_image,a.product_quantity,a.product_stype,a.product_keywords,b.cat_title,c.brand_title FROM products as a left join categories as b on a.product_cat=b.cat_id left join brands as c on a.product_brand=c.brand_id WHERE product_stype ='Sales, Rent and Exchange' AND NOT user_id = $user_id  LIMIT $startfrom,$num_rec_per_page";
$result = $con->query($qry);

//for search
/* $search="";
if(isset($_POST['search'])){
    $search = $_POST['search'];
    if (!empty($_POST['search'])) {
        $sql ="SELECT a.product_id,a.product_title,a.product_price,a.product_bprice,a.product_desc,a.product_image,a.product_quantity,a.product_stype,a.product_keywords,b.cat_title,c.brand_title FROM products as a left join categories as b on a.product_cat=b.cat_id left join brands as c on a.product_brand=c.brand_id WHERE product_stype ='Sales, Rent and Exchange' AND NOT user_id = $user_id or product_id like '%$search%' or cat_title like '%$search%' or brand_title like '%$search%' or product_title like '%$search%' or product_price like '%$search%'or product_bprice like '%$search%' or product_desc like '%$search%' or product_image like '%$search%' or product_quantity like '%$search%' or product_stype like '%$search%' or product_keywords like '%$search%'";
        $result = $con->query($sql);
    }
}
*/



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
<script>
function ConfirmExchange(){
    return confirm("Are you sure you want to exchange this product?");
}
</script>
<body>
<?php include("include/wheader.php"); ?>
<?php include("include/esidebar.php"); ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Select Exchange Products</h1>
            </div>
        </div>
        <div class="panel-body">
            <form method="POST" action="productExchange.php">
                <!--<input type="submit" name="search" value="Search" style="float: right;"/>
                <input type="text" name="search" placeholder="Value To Search" id="search" style="float: right;" /><br><br> -->

        <div class="dataTable_wrapper">
            <?php                                
            if ($result1->num_rows > 0) {
                echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'>
                <tr><th>ID</th><th>Category</th><th>Brand</th><th>Name</th><th>Price</th><th>Description</th><th>Image</th><th>Quantity</th></tr>";

                    while($row = mysqli_fetch_array($result1)) {
                        echo "<tr>
                            <td>" . $row["product_id"]. "</td>
                            <td>" . $row["cat_title"]. "</td>
                            <td>" . $row["brand_title"]. "</td>
                            <td>" . $row["product_title"]. "</td>
                            <td>" . $row["product_price"]."</td>
                            <td>" . $row["product_desc"]."</td>
                            <td><img src='product_images/".$row["product_image"]."'style='width:100px;height:135px;'></td>
                            <td>" . $row["product_quantity"]."</td>
                        </tr>";
                        }
                echo "</table>";
            } 
            else {
                echo "0 results";
            }

            ?>
        </div>
        <div class="dataTable_wrapper">
            <?php
                if ($result->num_rows > 0) {
                    echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'><form name='form2' method='post' action='adminVProduct.php'><tr><th>ID</th><th>Category</th><th>Brand</th><th>Name</th><th>Description</th><th>Image</th><th>Quantity</th><th>Operation</th></tr>"; 
                while($row = mysqli_fetch_array($result)) {
                    echo "<tr>
                            <td>" . $row['product_id']. "</td>
                            <td>" . $row['cat_title']. "</td>
                            <td>" . $row['brand_title']. "</td>
                            <td>" . $row['product_title']. "</td>
                            <td>" . $row['product_desc']."</td>
                            <td><img src='product_images/".$row['product_image']."'style='width:80px;height:100px;'></td>
                            <td>" . $row['product_quantity']."</td>
                            <td>
                            <button><a href='productExchange.php?selectedProduct=".$row['product_id']."' Onclick='return ConfirmExchange()'>Select</a>"."</button></td>
                        </tr>";
                }
                    echo "</table>";
                    $qry="select * from products where product_stype ='Sales, Rent and Exchange' AND NOT user_id = $user_id ";
                    $result=$con->query($qry);
                    $total_page=ceil(($result->num_rows/$num_rec_per_page));
                    echo "<ul class='pagination'>";
                    for ($i=1; $i<=$total_page; $i++) 
                    { 
                        echo"<li><a href='?pg=".$i."'>".$i."</li>";
                    }
                    echo"</ul>";
                } else {
                    echo "0 results";
                }
            ?>
        </div>
    </div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/metisMenu.min.js"></script>
<script src="js/startmin.js"></script>

</body>
</html>