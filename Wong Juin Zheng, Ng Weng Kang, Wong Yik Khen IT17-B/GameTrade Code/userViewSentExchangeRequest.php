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
    $sql="delete from exchange_request where exchange_id = '$cancel'";
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
$qry ="SELECT a.user_id,a.exchange_id,a.product_id,a.product_title,a.product_image,a.eproduct_id,a.eproduct_title,a.eproduct_image,a.request_date,b.first_name,c.status_detail FROM exchange_request as a left join user_info as b on a.exchanger_id=b.user_id left join status as c on a.status_detail=c.status_id where a.user_id='$user_id' ORDER BY exchange_id DESC LIMIT $startfrom,$num_rec_per_page";;
$result = $con->query($qry);

$search="";
if(isset($_POST['search'])){
    $search = $_POST['search'];
    if (!empty($_POST['search'])) {
        $sql ="SELECT a.user_id,a.exchange_id,a.product_id,a.product_title,a.product_image,a.eproduct_id,a.eproduct_title,a.eproduct_image,a.request_date,b.first_name,c.status_detail FROM exchange_request as a left join user_info as b on a.exchanger_id=b.user_id left join status as c on a.status_detail=c.status_id where a.user_id='$user_id' and product_title like '%$search%' or eproduct_title like '%$search%' or request_date like '%$search%'";
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
function ConfirmCancel(){
    return confirm("Are you sure you want to cancel?");
}
</script>
<body>
<?php include("include/wheader.php"); ?>
<?php include("include/ssidebar.php"); ?>
<div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Sent Exchange Request Status</h1>
                </div>
            </div>
            <div class="panel-body">
            <form action="userViewSentExchangeRequest.php" method="POST">
            <input type="submit" name="search" value="Search" style="float: right;"/>
                <input type="text" name="search" placeholder="Enter Value To Search" id="search" style="float: right;" /><br><br>
                                <div class="dataTable_wrapper">
                                    <?php                             
                                        if ($result->num_rows > 0) {
                                        echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                        <form name='form2' method='post' action='userViewSentExchangeRequest.php'>
                                        <tr><th>Request Date</th><th>Your Product Name</th><th>Your Product Image</th><th>Exchanger Name</th><th>Exchanger Product Name</th><th>Exchanger Product Image</th><th>Status</th><th>Operation</th></tr>";
                                        while($row = mysqli_fetch_array($result)) {
                                            echo "<tr>
                                            <td>" . $row["request_date"]."</td>
                                            <td>" . $row["product_title"]."</td>
                                            <td><img src='product_images/".$row["product_image"]."'style='width:100px;height:135px;'></td>
                                            <td>" . $row["first_name"]. "</td>
                                            <td>" . $row["eproduct_title"]."</td>
                                            <td><img src='product_images/".$row["eproduct_image"]."'style='width:100px;height:135px;'></td>
                                            <td>" . $row["status_detail"]."</td>
                                            <td>
                                            <button><a href='userViewSentExchangeRequest.php?cancel=".$row["exchange_id"]."' Onclick='return ConfirmCancel()'>Cancel</a>"."</button>
                                            </td></tr>";
                                        }
                                        echo "</table>";
                    
                                        $qry="select * from exchange_request where user_id='$user_id'";
                                        $result=$con->query($qry);
                                        $total_page=ceil(($result->num_rows/$num_rec_per_page));
                                        echo "<ul class='pagination'>";
                                        for ($i=1; $i<=$total_page; $i++) 
                                        { 
                                            echo"<li><a href='?pg=".$i."'>".$i."</li>";
                                        }
                                        echo"</ul>";
                                    } else {
                                        echo "<h4>No Exchange Request has been sent.<h4>";
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