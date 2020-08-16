<?php
include("include/db.php");
session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}

if(isset($_SESSION["uid"])){
    $user_id = $_SESSION["uid"];
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
$qry="SELECT a.product_id,a.user_id,a.product_title,a.product_price,a.product_bprice,a.product_desc,a.product_image,a.product_quantity,a.product_stype,a.product_keywords,b.cat_title,c.brand_title FROM products as a left join categories as b on a.product_cat=b.cat_id left join brands as c on a.product_brand=c.brand_id WHERE NOT a.user_id = '$user_id' AND NOT product_stype ='Sales Only' LIMIT $startfrom,$num_rec_per_page";
$result = $con->query($qry);

//for search
$search="";
if(isset($_POST['search'])){
    $search = $_POST['search'];
    if (!empty($_POST['search'])) {
        $sql ="SELECT a.product_id,a.user_id,a.product_title,a.product_price,a.product_bprice,a.product_desc,a.product_image,a.product_quantity,a.product_stype,a.product_keywords,b.cat_title,c.brand_title FROM products as a left join categories as b on a.product_cat=b.cat_id left join brands as c on a.product_brand=c.brand_id WHERE NOT a.user_id = '$user_id' AND NOT product_stype ='Sales Only' or product_id like '%$search%' or cat_title like '%$search%' or brand_title like '%$search%' or product_title like '%$search%' or product_price like '%$search%'or product_bprice like '%$search%' or product_desc like '%$search%' or product_image like '%$search%' or product_quantity like '%$search%' or product_stype like '%$search%' or product_keywords like '%$search%'";
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
function ConfirmRent(){
    return confirm("Are you sure you want to rent this product?");
}
</script>
<body>
<?php include("include/wheader.php"); ?>
<?php include("include/rsidebar.php"); ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Select Products to Rent</h1>
            </div>
        </div>
        <div class="panel-body">
            <form method="POST">
                <input type="submit" name="search" value="Search" style="float: right;"/>
                <input type="text" name="search" placeholder="Enter Value To Search" id="search" style="float: right;" /><br><br>

        <div class="dataTable_wrapper">
            <?php
                if ($result->num_rows > 0) {
                    echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'><form name='form2' method='post'><tr><th>Category</th><th>Brand</th><th>Name</th><th>Description</th><th>Image</th><th>Quantity</th><th>Operation</th></tr>"; 
                while($row = mysqli_fetch_array($result)) {
                    echo "<tr>
                            <td>" . $row['cat_title']. "</td>
                            <td>" . $row['brand_title']. "</td>
                            <td>" . $row['product_title']. "</td>
                            <td>" . $row['product_desc']."</td>
                            <td><img src='product_images/".$row['product_image']."'style='width:80px;height:100px;'></td>
                            <td>" . $row['product_quantity']."</td>
                            <td>
                            <button><a href='productRent.php?selectedRentProduct=".$row['product_id']."' Onclick='return ConfirmRent()'>Select</a>"."</button></td>
                        </tr>";
                }
                    echo "</table>";
                    
                    $qry="select * from products where product_stype ='Sales and Rent' or product_stype ='Sales, Rent and Exchange' AND NOT user_id = $user_id";
                    $result=$con->query($qry);
                    $total_page=ceil(($result->num_rows/$num_rec_per_page));
                    echo "<ul class='pagination'>";
                    for ($i=1; $i<=$total_page; $i++) 
                    { 
                        echo"<li><a href='?pg=".$i."'>".$i."</li>";
                    }
                    echo"</ul>";
                } else {
                    echo "No Related Product";
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