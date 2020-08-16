<?php
include("include/config.php");
session_start();

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
$qry="SELECT a.order_id,a.qty,a.trx_id,a.creation_date,a.p_status,b.first_name,c.product_title,c.user_id FROM orders as a left join user_info as b on a.user_id=b.user_id left join products as c on a.product_id=c.product_id LIMIT $startfrom,$num_rec_per_page";
$result = $db->query($qry);

//for search
$search="";
if(isset($_POST['search'])){
    $search = $_POST['search'];
    if (!empty($_POST['search'])) {
        $sql ="SELECT a.order_id,a.qty,a.trx_id,a.creation_date,a.p_status,b.first_name,c.product_title FROM orders as a left join user_info as b on a.user_id=b.user_id left join products as c on a.product_id=c.product_id WHERE first_name like '%$search%' or product_title like '%$search%' or qty like '%$search%' or trx_id like '%$search%'";
        $result = $db->query($sql);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>GameTrade Admin Controller</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/metisMenu.min.css" rel="stylesheet">

    <link href="css/timeline.css" rel="stylesheet">
    <link href="css/startmin.css" rel="stylesheet">
    <link href="css/morris.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php include("include/header.php"); ?>
<?php include("include/sidebar.php"); ?>
    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Manage Order</h1>
                </div>
            </div>
            <div class="panel-body">
            <form name="search" action="adminVOrder.php" method="POST">
            <input type="submit" name="search" value="Search" style="float: right;"/>
            <input type="text" name="search" placeholder="Enter Value To Search" id="search" style="float: right;" /><br><br>
                                <div class="dataTable_wrapper">
                                    <?php
                                    if ($result->num_rows > 0) {
                                        echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'><form name='form2' method='post' action='adminVUser.php'>
                                        <tr><th>Order Creation Date</th><th>Order ID</th><th>Buyer Name</th><th>Product ID</th><th>Quantity</th><th>Transaction ID</th><th>Product Status<th>Operation</th></tr>";
                                        while($row = mysqli_fetch_array($result)) {
                                            echo "<tr>
                                            <td>" . $row["creation_date"]. "</td>
                                            <td>" . $row["order_id"]. "</td>
                                            <td>" . $row["first_name"]. "</td>
                                            <td>" . $row["product_title"]."</td>
                                            <td>" . $row["qty"]."</td>
                                            <td>" . $row["trx_id"]."</td>
                                            <td>" . $row["p_status"]."</td>
                                            <td><button><a href='adminVSeller.php?seller=".$row["user_id"]."''>View Seller Details</a>"."</button></td></tr>";
                                            
                                        }
                                        echo "</table>";
                                        $qry="select * from orders";
                                        $result=$db->query($qry);
                                        $total_page=ceil(($result->num_rows/$num_rec_per_page));
                                        echo "<ul class='pagination'>";
                                        for ($i=1; $i<=$total_page; $i++) 
                                        { 
                                            echo"<li><a href='?pg=".$i."'>".$i."</li>";
                                        }
                                        echo"</ul>";
                                    } else {
                                        echo "0 Sales Report Record";
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
