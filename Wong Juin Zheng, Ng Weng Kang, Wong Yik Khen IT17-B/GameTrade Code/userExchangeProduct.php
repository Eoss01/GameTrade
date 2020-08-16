<?php
include("include/db.php");
session_start();
if(!isset($_SESSION["uid"])){
    header("location:index.php");

}

if(isset($_POST['edit'])){
    $a = $_POST['product_id'];
    $d = $_POST['productName'];
    $e = $_POST['productPrice'];
    $f = $_POST['productDesc'];
    //file upload start
    $productImage = $_FILES['productImage']['name'];
    $tmp_name = $_FILES['productImage']['tmp_name'];

    //var_dump($tmp_name);
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
    $h = $_POST['productStype'];
    $i = $_POST['productKey'];
    $j = $_POST['productDiscount'];
    $l = $_POST['rentPrice'];
    
    $sql = "UPDATE products SET  product_title='$d', product_price='$e', product_bprice='$j', product_desc='$f', product_image='$sql_location', product_quantity='$g', product_stype='$h', product_rentprice='$l', product_keywords='$i' WHERE product_id='$a'"; 
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
    $sql="delete from products where product_id = '$delete'";
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
$user_id = $_SESSION["uid"];
$qry="SELECT a.product_id,a.product_title,a.product_price,a.product_bprice,a.product_desc,a.product_image,a.product_quantity,a.product_stype,a.product_keywords,b.cat_title,c.brand_title 
FROM products as a left join categories as b on a.product_cat=b.cat_id left join brands as c on a.product_brand=c.brand_id where user_id = $user_id LIMIT $startfrom,$num_rec_per_page";
$result = $con->query($qry);

//for search
$search="";
if(isset($_POST['search'])){
    $search = $_POST['search'];
    if (!empty($_POST['search'])) {
        $sql ="SELECT a.user_id,a.product_id,a.product_title,a.product_price,a.product_bprice,a.product_desc,a.product_image,a.product_quantity,a.product_stype,a.product_keywords,b.cat_title,c.brand_title 
        FROM products as a left join categories as b on a.product_cat=b.cat_id left join brands as c on a.product_brand=c.brand_id WHERE user_id = $user_id and product_title like '%$search%' or product_desc like '%$search%'";
        $result = $con->query($sql);
    }
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
</head>
<script>
function ConfirmDelete(){
    return confirm("Are you sure you want to delete?");
}
</script>
<body>
<?php include("include/wheader.php"); ?>
<?php include("include/esidebar.php"); ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">View Personal Products</h1>
            </div>
        </div>
        <div class="panel-body">
            <form action="userExchangeProduct.php" method="POST">
                <button class="pull-left" data-toggle="modal"><i class="fa fa-plus-circle"><a href="userInsertExchangeProduct.php"></i>Add Product</a></button>
                <input type="submit" name="search" value="Search" style="float: right;"/>
                <input type="text" name="search" placeholder="Enter Value To Search" id="search" style="float: right;" /><br><br>

        <div class="dataTable_wrapper">
            <?php
                if ($result->num_rows > 0) {
                    echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'>
                    <form name='form2' method='post' action='userExchangeProduct.php'>
                    <tr><th>Category</th><th>Brand</th><th>Name</th><th>Discount Price</th><th>Original Price</th><th>Description</th><th>Image</th><th>Quantity</th><th>Sales Type</th><th>Operation</th></tr>"; 
                while($row = mysqli_fetch_array($result)) {
                    echo "<tr>
                            <td>" . $row['cat_title']. "</td>
                            <td>" . $row['brand_title']. "</td>
                            <td>" . $row['product_title']. "</td>
                            <td>" . $row['product_price']."</td>
                            <td>" . $row['product_bprice']."</td>
                            <td>" . $row['product_desc']."</td>
                            <td><img src='product_images/".$row['product_image']."'style='width:80px;height:100px;'></td>
                            <td>" . $row['product_quantity']."</td>
                            <td>" . $row['product_stype']."</td>
                            <td>
                            <button><a href='productExchange.php?exchange=".$row["product_id"]."'>Exchange</a></button>  
                            <button><a href='userExchangeProduct.php?delete=".$row['product_id']."' Onclick='return ConfirmDelete()'>Delete</a>"."</button>
                            </td>
                        </tr>";
                }
                    echo "</table>";
                    
                    $qry="select * from products where user_id = $user_id ";
                    $result=$con->query($qry);
                    $total_page=ceil(($result->num_rows/$num_rec_per_page));
                    echo "<ul class='pagination'>";
                    for ($i=1; $i<=$total_page; $i++) 
                    { 
                        echo"<li><a href='?pg=".$i."'>".$i."</li>";
                    }
                    echo"</ul>";
                } else {
                    echo "<h4>You don't have any personal product.<h4>";
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