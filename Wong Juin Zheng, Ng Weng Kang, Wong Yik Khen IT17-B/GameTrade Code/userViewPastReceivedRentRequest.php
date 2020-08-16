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

    $sql="UPDATE rent_request set rent_status='4' WHERE rent_id='$success'";
    $result = $con->query($sql);

}

//pagination
$num_rec_per_page=10;
if(isset($_GET['pg'])){
    $pg=$_GET['pg'];
}
else{
    $pg=1;
}
$startfrom=( $pg-1 ) * $num_rec_per_page;
$qry ="SELECT a.rent_id,a.product_id,a.product_title,a.qty,a.rent_price,a.start_date,a.end_date,a.request_date,b.first_name,b.address,c.status_detail FROM rent_request as a left join user_info as b on a.user_id=b.user_id left join status as c on a.rent_status=c.status_id where a.renter_id='$user_id' AND rent_status='2' or rent_status='4' ORDER BY rent_id DESC LIMIT $startfrom,$num_rec_per_page";
$result = $con->query($qry);

$search="";
if(isset($_POST['search'])){
    $search = $_POST['search'];
    if (!empty($_POST['search'])) {
        $sql ="SELECT a.rent_id,a.product_id,a.product_title,a.qty,a.rent_price,a.start_date,a.end_date,a.request_date,b.first_name,b.address,c.status_detail FROM rent_request as a left join user_info as b on a.user_id=b.user_id left join status as c on a.rent_status=c.status_id where a.renter_id='$user_id' AND rent_status='2' or rent_status='4' and product_title like '%$search%'";
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
                    <h1 class="page-header">View Past Received Rent Request Status</h1>
                </div>
            </div>
            <div class="panel-body">
            <form action="userViewPastReceivedRentRequest.php" method="POST">
            <button class="pull-left" data-toggle="modal"><i class="fa fa-plus-circle"><a href="userViewReceivedRentRequest.php"></i>Return</a></button>
            <input type="submit" name="search" value="Search" style="float: right;"/>
                <input type="text" name="search" placeholder="Enter Value To Search" id="search" style="float: right;" /><br><br>
                                <div class="dataTable_wrapper">
                                    <?php                                
                                    if ($result->num_rows > 0) {
                                        echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                        <form name='form' method='post' action='userViewPastReceivedRentRequest.php'>
                                        <tr><th>Request Date</th><th>Customer Name</th><th>Customer Address</th><th>Product Name</th><th>Quantity</th><th>Rent Price</th><th>Start Date</th><th>End Date</th><th>Status</th><th>Operation</th></tr>";
                                        while($row = mysqli_fetch_array($result)) {
                                            if($row['status_detail']=="Successfully delivery."){
                                                $disable_button=" class='btn btn-success' disabled>Successfully Delivery";
                                            }
                                            else
                                            {
                                                $disable_button="><a href='userViewPastReceivedRentRequest.php?success=".$row['rent_id']."' Onclick='return ConfirmSuccess()'>Sucessful Delivery</a>";
                                            }
                                            echo "<tr>
                                            <td>" . $row["request_date"]."</td>
                                            <td>" . $row["first_name"]. "</td>
                                            <td>" . $row["address"]. "</td>
                                            <td>" . $row["product_title"]. "</td>
                                            <td>" . $row["qty"]. "</td>
                                            <td>" . $row["rent_price"]. "</td>
                                            <td>" . $row["start_date"]."</td>
                                            <td>" . $row["end_date"]."</td>
                                            <td>" . $row["status_detail"]."</td>
                                            <td><button ".$disable_button."</button>  
                                            </td></tr>";
                                        }
                                        echo "</table>";
                    
                                        $qry="select * from rent_request where renter_id='$user_id'";
                                        $result=$con->query($qry);
                                        $total_page=ceil(($result->num_rows/$num_rec_per_page));
                                        echo "<ul class='pagination'>";
                                        for ($i=1; $i<=$total_page; $i++) 
                                        { 
                                            echo"<li><a href='?pg=".$i."'>".$i."</li>";
                                        }
                                        echo"</ul>";
                                    } else {
                                        echo "<h4>No Past Rent Request record.</h4>";
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