<?php
include("include/db.php");
session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}

if(isset($_SESSION["uid"])){
    $user_id = $_SESSION["uid"];
}

$disable_button = "";

if(isset($_GET['success'])){
    $success = $_GET['success'];

    $sql1 = "SELECT a.exchange_id, a.product_id, b.product_id , b.product_quantity FROM exchange_request as a left join products as b on a.product_id=b.product_id WHERE a.exchange_id = '$success'";
    $run_query1 = mysqli_query($con,$sql1);
    $getProdInfo = mysqli_fetch_array($run_query1);
    $product_id = $getProdInfo['product_id'];
    $product_quantity = $getProdInfo['product_quantity'];

    $sql2 = "SELECT a.exchange_id, a.eproduct_id , b.product_id , b.product_quantity FROM exchange_request as a left join products as b on a.eproduct_id=b.product_id WHERE a.exchange_id = '$success'";
    $run_query2 = mysqli_query($con,$sql2);
    $getEProdInfo = mysqli_fetch_array($run_query2);
    $eproduct_id = $getEProdInfo['product_id'];
    $eproduct_quantity = $getEProdInfo['product_quantity'];

    $sql3 = "UPDATE exchange_request set status_detail='4' WHERE exchange_id='$success'";
    $result3 = $con->query($sql3);

    $quantity = $getProdInfo['product_quantity'] - 1;
    $sql4 = "UPDATE products SET product_quantity = '$quantity' WHERE product_id = '$product_id'";
    $result4 = $con->query($sql4);

    $quantityE = $getEProdInfo['product_quantity'] - 1;
    $sql5 = "UPDATE products SET product_quantity = '$quantityE' WHERE product_id = '$eproduct_id'";
    $result5 = $con->query($sql5);

    $sql6= $sql3.";".$sql4.";".$sql5.";";

    $result1 = mysqli_multi_query($con,$sql6);
    if($result1) {
        //echo "Error: " . $sql4 . "<br>" . mysqli_error($con);
        //echo "Error: " . $sql5 . "<br>" . mysqli_error($con);
        echo "<script>alert('Exchange Sucessful');</script>";
        echo "<script>window.location.assign('userViewPastReceivedExchangeRequest.php');</script>";
    }
    else
    {
        echo "<script>alert('Exchange Failed');</script>";
        echo "<script>window.location.assign('userViewPastReceivedExchangeRequest.php');</script>";
    }

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
$qry="SELECT a.exchange_id,a.product_id,a.product_title,a.product_image,a.eproduct_id,a.eproduct_title,a.eproduct_image,a.status_detail,a.request_date,b.first_name,b.address,c.status_detail FROM exchange_request as a 
left join user_info as b on a.user_id=b.user_id left join status as c on a.status_detail=c.status_id where exchanger_id='$user_id' and not a.status_detail='1' and not a.status_detail='3' and not a.status_detail='5'
ORDER BY exchange_id DESC LIMIT $startfrom,$num_rec_per_page";
$result = $con->query($qry);

$search="";
if(isset($_POST['search'])){
    $search = $_POST['search'];
    if (!empty($_POST['search'])) {
        $sql ="SELECT a.exchange_id,a.product_id,a.product_title,a.product_image,a.eproduct_id,a.eproduct_title,a.eproduct_image,a.status_detail,a.request_date,b.first_name,b.address,c.status_detail FROM exchange_request as a 
        left join user_info as b on a.user_id=b.user_id left join status as c on a.status_detail=c.status_id where exchanger_id='$user_id' and not a.status_detail='1' and not a.status_detail='3' and not a.status_detail='5'
        and product_title like '%$search%'";
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
function ConfirmSuccess(){
    return confirm("Are you sure you want to set this request status to successful delivery?");
}
</script>
<body>
<?php include("include/wheader.php"); ?>
<?php include("include/ssidebar.php"); ?>
<div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Past Received Exchange Request Status</h1>
                    
                </div>
            </div>
            <div class="panel-body">
            <form action="userViewPastReceivedExchangeRequest.php" method="POST">
            <button class="pull-left" data-toggle="modal"><i class="fa fa-plus-circle"><a href="userViewReceivedExchangeRequest.php"></i>Return</a></button>
            <input type="submit" name="search" value="Search" style="float: right;"/>
                <input type="text" name="search" placeholder="Enter Value To Search" id="search" style="float: right;" /><br><br>
                                <div class="dataTable_wrapper">
                                    <?php                       
                                        if ($result->num_rows > 0) {
                                        echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                        <form name='form' method='post' action='userViewPastReceivedExchangeRequest.php'>
                                        <tr><th>Request Date</th><th>Your Product Name</th><th>Your Product Image</th><th>Requester Name</th><th>Requester Product Name</th><th>Requester Product Image</th><th>Requester Address</th><th>Status</th><th>Operation</th></tr>";
                                        while($row = mysqli_fetch_array($result)) {
                                            if($row['status_detail']=="Successfully delivery."){
                                                $disable_button=" class='btn btn-success' disabled>Successfully Delivery";
                                            }
                                            else
                                            {
                                                $disable_button="><a href='userViewPastReceivedExchangeRequest.php?success=".$row['exchange_id']."' Onclick='return ConfirmSuccess()'>Sucessful Delivery</a>";
                                            }
                                            echo "<tr>
                                            <td>" . $row["request_date"]. "</td>
                                            <td>" . $row["eproduct_title"]."</td>
                                            <td><img src='product_images/".$row["eproduct_image"]."'style='width:100px;height:135px;'></td>
                                            <td>" . $row["first_name"]. "</td>
                                            <td>" . $row["product_title"]."</td>
                                            <td><img src='product_images/".$row["product_image"]."'style='width:100px;height:135px;'></td>
                                            <td>" . $row["address"]."</td>
                                            <td>" . $row["status_detail"]."</td>
                                            <td><button ".$disable_button."</button>  
                                            </td></tr>";
                                        }
                                        echo "</table>";
                    
                                        $qry="select * from exchange_request where exchanger_id='$user_id'";
                                        $result=$con->query($qry);
                                        $total_page=ceil(($result->num_rows/$num_rec_per_page));
                                        echo "<ul class='pagination'>";
                                        for ($i=1; $i<=$total_page; $i++) 
                                        { 
                                            echo"<li><a href='?pg=".$i."'>".$i."</li>";
                                        }
                                        echo"</ul>";
                                    } else {
                                        echo "<h4>No Rent Request has been received.</h4>";
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