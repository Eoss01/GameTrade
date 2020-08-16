<?php
include("include/db.php");
session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}

if(isset($_SESSION["uid"])){
    $user_id = $_SESSION["uid"];
}

if(isset($_GET['cancel'])){
    $cancel=$_GET['cancel'];
    $sql="delete from exchange_request where uproduct_id = '$cancel'";
    $result = $con->query($sql);
}

if(isset($_GET['selectedProduct'])){
    $product_id = $_GET['selectedProduct'];

    $sql = "SELECT * FROM products WHERE product_id='$product_id'";
    $run_query = mysqli_query($con,$sql);

    $getProdInfo = mysqli_fetch_array($run_query);
    $product_id = $getProdInfo["product_id"];
    $product_title = $getProdInfo["product_title"];
    $product_image = $getProdInfo["product_image"];
    $product_quantity = $getProdInfo["product_quantity"];

    $uproduct_id = $_GET['exchange'];
    
    $sql = "SELECT * FROM user_products WHERE uproduct_id='$uproduct_id'";
    $run_query = mysqli_query($con,$sql);
    
    $getUserProdInfo = mysqli_fetch_array($run_query);
    $uproduct_id = $getUserProdInfo["uproduct_id"];
    $uproduct_title = $getUserProdInfo["uproduct_title"];
    $uproduct_image = $getUserProdInfo["uproduct_image"];
    $uproduct_quantity = $getUserProdInfo["uproduct_quantity"];
    
    $sql="INSERT INTO exchange_request(user_id,uproduct_id,uproduct_title,uproduct_image,product_id,product_titleproduct_image,status) VALUES ('$user_id','$uproduct_id',$uproduct_title','$uproduct_image','$uproduct_id',$uproduct_title','$uproduct_image','Pending by admin,please wait.')";
    $result = $con->query($sql);
    
    }

//pagination
$num_rec_per_page=5;
if(isset($_GET['pg']))
{
    $pg=$_GET['pg'];
}
else
{
    $pg=1;
}
$startfrom=( $pg-1 ) * $num_rec_per_page;
$qry="SELECT * FROM exchange_request WHERE user_id = '$user_id' LIMIT $startfrom,$num_rec_per_page";
$result = $con->query($qry);


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
function ConfirmCancel(){
    return confirm("Are you sure you want to cancel?");
}

</script>
<body>
<?php include("include/wheader.php"); ?>
<?php include("include/sidebar.php"); ?>
<div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Exchange Request</h1>
                </div>
            </div>
            <div class="panel-body">

                                <div class="dataTable_wrapper">
                                    <?php                                
                                    if ($result->num_rows > 0) {
                                        echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'><form name='form2' method='post' action='userVProduct.php'><tr><th>User</th><th>Name</th><th>Price</th><th>Description</th><th>Image</th><th>Quantity</th><th>Status</th><th>Operation</th></tr>";
                                        while($row = mysqli_fetch_array($result)) {
                                            echo "<tr>
                                            <td>" . $row["uproduct_brand"]. "</td>
                                            <td>" . $row["uproduct_title"]. "</td>
                                            <td>" . $row["uproduct_price"]."</td>
                                            <td>" . $row["uproduct_desc"]."</td>
                                            <td><img src='product_images/".$row["uproduct_image"]."'style='width:100px;height:150px;'></td>
                                            <td>" . $row["uproduct_quantity"]."</td>
                                            <td>" . $row["status"]."</td>
                                            <td>
                                            <button><a href='userVsRequest.php?cancel=".$row["uproduct_id"]."' Onclick='return ConfirmCancel()'>Cancel</a>"."</button>
                                            </td></tr>";
                                        }
                                        echo "</table>";
                    
                                        $qry="select * from exchange_request where user_id = '$user_id'";
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

</div>


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/metisMenu.min.js"></script>
<script src="js/startmin.js"></script>

</body>
</html>