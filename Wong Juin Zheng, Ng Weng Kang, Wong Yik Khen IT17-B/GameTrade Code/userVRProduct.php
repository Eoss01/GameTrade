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
    $sql="delete from rent_request where product_id = '$cancel'";
    $result = $con->query($sql);
}


//pagination
$num_rec_per_page=5;
if(isset($_GET['pg'])){
    $pg=$_GET['pg'];
}
else{
    $pg=1;
}
$startfrom=( $pg-1 ) * $num_rec_per_page;
$qry="SELECT * FROM rent_request WHERE user_id = '$user_id' LIMIT $startfrom,$num_rec_per_page";
$result = $con->query($qry);

if(isset($_POST['submit'])){
    $user_id = $_SESSION["uid"];
    $product_id = $_POST['productId'];
    $product_title = $_POST['productName'];
    $rent_price = $_POST['total'];
    $start_date = \DateTime::createFromFormat('y/m/d', $_POST['pick_date']);
    $end_date  = \DateTime::createFromFormat('y/m/d', $_POST['drop_date']);
    $sql = "INSERT INTO rent_request(user_id, product_id,product_title,rent_price,start_date,end_date,status) VALUES ('$user_id','$product_id','$product_title','$rent_price',STR_TO_DATE('$start_date', '%Y/%m/%d'),STR_TO_DATE('$end_date', '%Y/%m/%d'),'Pending by admin,please wait.')";
    $result = $con->query($sql);
    if($sql){
        echo "<script>alert('Insert Successfully');</script>";
        echo "<script>window.location.assign('userVRProduct.php');</script>";
    }else{
        echo "<script>alert('Insert Failed');</script>";
        
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
                    <h1 class="page-header">View Rent Product</h1>
                </div>
            </div>
            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <?php                                
                                    if ($result->num_rows > 0) {
                                        echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'><form name='form2' method='post' action='userVRProduct.php'><tr><th>Request Date</th><th>Product Name</th><th>Rent Price</th><th>Start Date</th><th>End Date</th><th>Status</th><th>Operation</th></tr>";
                                        while($row = mysqli_fetch_array($result)) {
                                            echo "<tr>
                                            <td>" . $row["request_date"]."</td>
                                            <td>" . $row["product_title"]. "</td>
                                            <td>" . $row["rent_price"]. "</td>
                                            <td>" . $row["start_date"]."</td>
                                            <td>" . $row["end_date"]."</td>
                                            <td>" . $row["status"]."</td>
                                            <td>
                                            <button><a href='userVRPoduct.php?cancel=".$row["product_id"]."' Onclick='return ConfirmCancel()'>Cancel</a>"."</button>
                                            </td></tr>";
                                        }
                                        echo "</table>";
                    
                                        $qry="select * from rent_request where user_id = '$user_id'";
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