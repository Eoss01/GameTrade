<?php
include("include/config.php");

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="delete from products where productId= '$id'";
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
                    <h1 class="page-header">View Products</h1>
                </div>
            </div>
            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <?php
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
 
                                    if ($result->num_rows > 0) {
                                        echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'><tr><th>ID</th><th>CID</th><th>SCID</th><th>Name</th><th>Price</th><th>Description</th><th>Image</th><th>Key Words</th><th>Operation</th></tr>";
                                        while($row = mysqli_fetch_array($result)) {
                                            echo "<tr>
                                            <td>" . $row["product_id"]. "</td>
                                            <td>" . $row["product_cat"]. "</td>
                                            <td>" . $row["product_brand"]. "</td>
                                            <td>" . $row["product_title"]. "</td>
                                            <td>" . $row["product_price"]."</td>
                                            <td>" . $row["product_desc"]."</td>
                                            <td>" . $row["product_image"]."</td>
                                            <td>" . $row["product_keywords"]."</td>
                                            <td><a href='productEdit.php?edit=".$row["product_id"]."'>Edit</a>  /
                                            <a href='adminVProduct.php?id=".$row["product_id"]."' Onclick='return ConfirmDelete()'>Delete</a>"."</td></tr>";
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
