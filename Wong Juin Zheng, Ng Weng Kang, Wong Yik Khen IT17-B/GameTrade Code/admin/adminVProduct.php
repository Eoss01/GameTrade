<?php
include("include/config.php");
session_start();

if(isset($_POST['edit'])){
    $a = $_POST['product_id'];
    $b = $_POST['categoryId'];
    $c = $_POST['brandId'];
    $d = $_POST['productName'];
    $e = $_POST['productPrice'];
    $f = $_POST['productDesc'];
    //file upload start
    $productImage1 = $_FILES['productImage1']['name'];
    $tmp_name = $_FILES['productImage1']['tmp_name'];
    $productImage2 = $_FILES['productImage2']['name'];
    $tmp_name = $_FILES['productImage2']['tmp_name'];
    $productImage3 = $_FILES['productImage3']['name'];
    $tmp_name = $_FILES['productImage3']['tmp_name'];
    // var_dump($tmp_name);
    if (empty($tmp_name)) {
        $sql_location = '';
    }
    else
    {
        $location = "product_images/";  
        move_uploaded_file($tmp_name, $location.$productImage1);
        move_uploaded_file($tmp_name, $location.$productImage2);
        move_uploaded_file($tmp_name, $location.$productImage3);
        //file upload end
        $sql_location = "$productImage1";
        $sql_location = "$productImage2";
        $sql_location = "$productImage3";
    }
    $g = $_POST['productQuantity'];
    $h = $_POST['productStype'];
    $i = $_POST['productKey'];
    

    $sql = "UPDATE products SET product_cat='$b', product_brand='$c', product_title='$d', product_price='$e', product_desc='$f', product_image1='$sql_location', product_image2='$sql_location',product_image3='$sql_location',product_quantity='$g' , product_stype='$h' , product_keywords='$i' WHERE product_id='$a'"; 
    $result = $db->query($sql);

    if($db->query($sql)===TRUE)
    {
        echo "<script>alert('Edit Successfully');</script>";
        echo "<script>window.location='productEdit.php?edit='';</script>";
    }
    else
    {
        echo "Error: ".$sql."<br>".$db->error;
    }

}

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="delete from products where product_id = '$id'";
    $result = $db->query($sql);
}
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
<script>
function ConfirmDelete(){
    return confirm("Are you sure you want to delete?");
}
</script>
<body>
<?php include("include/header.php"); ?>
<?php include("include/sidebar.php"); ?>
<div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Products</h1><button class="pull-right" data-toggle="modal" data-target="#addcustomer"><i class="fa fa-plus-circle"><a href="adminIProduct.php"></i>Add Product</a></button>
                </div>
            </div>
            <div class="panel-body">
            <form name="search" action="adminVProduct.php" method="POST">
            <input type="submit" name="searchbtn" value="Search" style="float: right;"/>
            <input name="search" id="search" type="text" style="float: right;" />
                                <div class="dataTable_wrapper">
                                    <?php
                                    $search="";

                                    if(isset($_POST['search'])){
                                        $search=$_POST['search'];
                                        $search="where product_title like '%$search%'";
                                        
                                    }                                    
                                     $results_per_page = 5;
                                     $sql = "SELECT * FROM products";
                                     $result = $db->query($sql);
                                     $number_of_results = mysqli_num_rows($result);
                                     $number_of_pages = ceil($number_of_results/$results_per_page);
                                     if (!isset($_GET['page'])) {
                                         $page = 1;
                                       } else {
                                         $page = $_GET['page'];
                                       }
                                     $this_page_first_result = ($page-1)*$results_per_page;
                                     $sql='SELECT * FROM products LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
                                     $result = mysqli_query($db, $sql);

                                    $sql='SELECT * FROM products ' . $search ;
                                    $result = mysqli_query($db, $sql);
                                    
                                    if ($result->num_rows > 0) {
                                        echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'><form name='form2' method='post' action='adminVProduct.php'><tr><th>ID</th><th>CID</th><th>SCID</th><th>Name</th><th>Price</th><th>Description</th><th>Image</th><th>Quantity</th><th>Sales Type</th><th>KeyWords</th><th>Operation</th></tr>";
                                        while($row = mysqli_fetch_array($result)) {
                                            echo "<tr>
                                            <td>" . $row["product_id"]. "</td>
                                            <td>" . $row["product_cat"]. "</td>
                                            <td>" . $row["product_brand"]. "</td>
                                            <td>" . $row["product_title"]. "</td>
                                            <td>" . $row["product_price"]."</td>
                                            <td>" . $row["product_desc"]."</td>
                                            <td><img src='product_images/".$row["product_image"]."'style='width:100px;height:150px;'></td>
                                            <td>" . $row["product_quantity"]."</td>
                                            <td>" . $row["product_stype"]."</td>
                                            <td>" . $row["product_keywords"]."</td>
                                            <td><button><a href='productEdit.php?edit=".$row["product_id"]."'>Edit</a></button> 
                                            <button><a href='adminVProduct.php?id=".$row["product_id"]."' Onclick='return ConfirmDelete()'>Delete</a>"."</button></td></tr>";
                                        }
                                        echo "</table>";
                                    } else {
                                        echo "0 results";
                                    }
                                    for ($page=1;$page<=$number_of_pages;$page++) {
                                        echo '<ul class="pagination justify-content-center">
                                                <li class="page-item">
                                                    <a class="page-link" href="adminVProduct.php?page=' . $page . '">' . $page . '</a>
                                                    </li>
                                                </ul>';
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