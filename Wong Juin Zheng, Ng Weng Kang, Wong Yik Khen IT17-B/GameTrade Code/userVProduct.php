<?php
include("include/db.php");
session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}

if(isset($_SESSION["uid"])){
    $user_id = $_SESSION["uid"];
}

if(isset($_POST['edit'])){
    $a = $_POST['product_id'];
    $c = $_POST['brandId'];
    $d = $_POST['productName'];
    $e = $_POST['productPrice'];
    $f = $_POST['productDesc'];
    //file upload start
    $productImage = $_FILES['productImage']['name'];
    $tmp_name = $_FILES['productImage']['tmp_name'];

    // var_dump($tmp_name);
    if (empty($tmp_name)) {
        $sql_location = '';
    }
    else
    {
        $location = "product_images/";  
        move_uploaded_file($tmp_name, $location.$productImage);
        //file upload end
        $sql_location = "$productImage";
    }
    $g = $_POST['productQuantity'];
    

    $sql = "UPDATE user_products SET uproduct_cat='$b', uproduct_brand='$c', uproduct_title='$d', uproduct_price='$e', uproduct_desc='$f', uproduct_image='$sql_location', uproduct_quantity='$g' WHERE uproduct_id='$a'"; 
    $result = $con->query($sql);

    if($con->query($sql)===TRUE)
    {
        echo "<script>alert('Edit Successfully');</script>";
        echo "<script>window.location='productEdit.php?edit='';</script>";
    }
    else
    {
        echo "Error: ".$sql."<br>".$con->error;
    }

}

if(isset($_GET['delete'])){
    $delete=$_GET['delete'];
    $sql="delete from user_products where uproduct_id = '$delete'";
    $result = $con->query($sql);
}


if(isset($_GET['sales'])){
    $product_id = $_GET['sales'];

    $sql = "SELECT * FROM user_products WHERE uproduct_id='$product_id'";
    $run_query = mysqli_query($con,$sql);
    
    $getProdInfo = mysqli_fetch_array($run_query);
    $product_brand =$getProdInfo["uproduct_brand"];
    $product_title = $getProdInfo["uproduct_title"];
    $product_price = $getProdInfo['uproduct_price'];
    $product_desc = $getProdInfo['uproduct_desc'];
    $product_image = $getProdInfo["uproduct_image"];
    $product_quantity = $getProdInfo["uproduct_quantity"];

    $sql="INSERT INTO sales_request(user_id,uproduct_id,uproduct_brand,uproduct_title,uproduct_price,uproduct_desc,uproduct_image,uproduct_quantity,status) VALUES ('$user_id','$product_id','$product_brand','$product_title','$product_price','$product_desc','$product_image','$product_quantity','Pending by admin,please wait.')";
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
$qry="SELECT * FROM user_products WHERE user_id = '$user_id' LIMIT $startfrom,$num_rec_per_page";
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
function ConfirmDelete(){
    return confirm("Are you sure you want to delete?");
}

function ConfirmSales(){
    return confirm("Are you sure you want to sales?");
}
</script>
<body>
<?php include("include/wheader.php"); ?>
<?php include("include/sidebar.php"); ?>
<div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Products</h1><button class="pull-right" data-toggle="modal" data-target="#addcustomer"><i class="fa fa-plus-circle"><a href="userIProduct.php"></i>Add Product</a></button>
                </div>
            </div>
            <div class="panel-body">

                                <div class="dataTable_wrapper">
                                    <?php                                
                                    if ($result->num_rows > 0) {
                                        echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'><form name='form2' method='post' action='userVProduct.php'><tr><th>Category</th><th>Name</th><th>Price</th><th>Description</th><th>Image</th><th>Quantity</th><th>Status</th><th>Operation</th></tr>";
                                        while($row = mysqli_fetch_array($result)) {
                                            echo "<tr>
                                            <td>" . $row["uproduct_brand"]. "</td>
                                            <td>" . $row["uproduct_title"]. "</td>
                                            <td>" . $row["uproduct_price"]."</td>
                                            <td>" . $row["uproduct_desc"]."</td>
                                            <td><img src='product_images/".$row["uproduct_image"]."'style='width:100px;height:150px;'></td>
                                            <td>" . $row["uproduct_quantity"]."</td>
                                            <td>" . $row["uproduct_status"]."</td>
                                            <td><button><a href='productEdit.php?edit=".$row["uproduct_id"]."'>Edit</a></button>  
                                            <button><a href='userVProduct.php?delete=".$row["uproduct_id"]."' Onclick='return ConfirmDelete()'>Delete</a>"."</button>
                                            <button><a href='userVProduct.php?sales=".$row["uproduct_id"]."' Onclick='return ConfirmSales()'>Sales</a>"."</button>
                                            <button><a href='productExchange.php?exchange=".$row["uproduct_id"]."'>Exchange</a></button>  
                                            </td></tr>";
                                        }
                                        echo "</table>";
                    
                                        $qry="select * from user_products where user_id = '$user_id'";
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