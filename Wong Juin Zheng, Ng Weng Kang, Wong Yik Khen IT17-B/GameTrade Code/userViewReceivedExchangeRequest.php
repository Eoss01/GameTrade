<?php
include("include/db.php");
session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}

if(isset($_SESSION["uid"])){
    $user_id = $_SESSION["uid"];
}

if(isset($_GET['accept'])){
    $accept = $_GET['accept'];

    $sql="UPDATE exchange_request set status_detail='2' WHERE exchange_id='$accept'";
    $result = $con->query($sql);

}

if(isset($_GET['decline'])){
    $decline = $_GET['decline'];

    $sql="UPDATE exchange_request set status_detail='3' WHERE exchange_id='$decline'";
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
$qry="SELECT a.exchanger_id,a.exchange_id,a.product_id,a.product_title,a.product_image,a.eproduct_id,a.eproduct_title,a.eproduct_image,a.status_detail,a.request_date,b.first_name,b.address,c.status_detail FROM exchange_request as a left join user_info as b on a.user_id=b.user_id left join status as c on a.status_detail=c.status_id where a.exchanger_id='$user_id' and a.status_detail='1' ORDER BY exchange_id DESC LIMIT $startfrom,$num_rec_per_page";
$result = $con->query($qry);

$search="";
if(isset($_POST['search'])){
    $search = $_POST['search'];
    if (!empty($_POST['search'])) {
        $sql ="SELECT a.exchanger_id,a.exchange_id,a.product_id,a.product_title,a.product_image,a.eproduct_id,a.eproduct_title,a.eproduct_image,a.status_detail,a.request_date,b.first_name,b.address,c.status_detail FROM exchange_request as a left join user_info as b on a.user_id=b.user_id left join status as c on a.status_detail=c.status_id where a.exchanger_id='$user_id'  and a.status_detail='1' and product_title like '%$search%'";
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
function ConfirmAccept(){
    return confirm("Are you sure you want to accept this request?");
}

function ConfirmDecline(){
    return confirm("Are you sure you want to decline this request?");
}
</script>
<body>
<?php include("include/wheader.php"); ?>
<?php include("include/ssidebar.php"); ?>
<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Received Exchange Request Status</h1>
                </div>
            </div>
            <div class="panel-body">
            <form action="userViewReceivedExchangeRequest.php" method="POST">
            <button class="pull-left" data-toggle="modal"><i class="fa fa-plus-circle"><a href="userViewPastReceivedExchangeRequest.php"></i>View Past Request</a></button>
            <input type="submit" name="search" value="Search" style="float: right;"/>
                <input type="text" name="search" placeholder="Enter Value To Search" id="search" style="float: right;" /><br><br>
                                <div class="dataTable_wrapper">
                                    <?php                       
                                        if ($result->num_rows > 0) {
                                        echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                        <form name='form' method='post' action='userViewReceivedExchangeRequest.php'>
                                        <tr><th>Request Date</th><th>Your Product Name</th><th>Your Product Image</th><th>Requester Name</th><th>Requester Product Name</th><th>Requester Product Image</th><th>Requester Address</th><th>Status</th><th>Operation</th></tr>";
                                        while($row = mysqli_fetch_array($result)) {
                                            echo "<tr>
                                            <td>" . $row["request_date"]."</td>
                                            <td>" . $row["eproduct_title"]."</td>
                                            <td><img src='product_images/".$row["eproduct_image"]."'style='width:100px;height:135px;'></td>
                                            <td>" . $row["first_name"]. "</td>
                                            <td>" . $row["product_title"]."</td>
                                            <td><img src='product_images/".$row["product_image"]."'style='width:100px;height:135px;'></td>
                                            <td>" . $row["address"]."</td>
                                            <td>" . $row["status_detail"]."</td>
                                            <td>
                                            <button><a href='userViewReceivedExchangeRequest.php?accept=".$row['exchange_id']."' Onclick='return ConfirmAccept()'>Accept</a></button>    
                                            <button><a href='userViewReceivedExchangeRequest.php?decline=".$row['exchange_id']."' Onclick='return ConfirmDecline()'>Decline</a>"."</button>

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