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
    $sql="delete from rent_request where rent_id = '$cancel'";
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
$qry ="SELECT a.rent_id,a.product_id,a.product_title,a.rent_price,a.start_date,a.end_date,a.request_date,b.first_name,c.status_detail FROM rent_request as a left join user_info as b on a.renter_id=b.user_id left join status as c on a.rent_status=c.status_id where a.user_id='$user_id' ORDER BY rent_id DESC LIMIT $startfrom,$num_rec_per_page";;
$result = $con->query($qry);

$search="";
if(isset($_POST['search'])){
    $search = $_POST['search'];
    if (!empty($_POST['search'])) {
        $sql ="SELECT a.rent_id,a.product_id,a.product_title,a.rent_price,a.start_date,a.end_date,a.request_date,b.first_name,c.status_detail FROM rent_request as a left join user_info as b on a.renter_id=b.user_id left join status as c on a.rent_status=c.status_id where a.user_id='$user_id' and product_title like '%$search%' or request_date like '%$search%'";
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
                    <h1 class="page-header">View Sent Rent Request Status</h1>
                </div>
            </div>
            <div class="panel-body">
            <form action="userViewSentRentRequest.php" method="POST">
            <input type="submit" name="search" value="Search" style="float: right;"/>
                <input type="text" name="search" placeholder="Enter Value To Search" id="search" style="float: right;" /><br><br>
                                <div class="dataTable_wrapper">
                                    <?php             
                                    if ($result->num_rows > 0) {
                                        echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                        <form name='form' method='post' action='userViewSentRentRequest.php'>
                                        <tr><th>Request Date</th><th>Product Name</th><th>Rent Price</th><th>Start Date</th><th>End Date</th><th>Status</th><th>Operation</th></tr>";
                                        while($row = mysqli_fetch_array($result)) {
                                            echo "<tr>
                                            <td>" . $row["request_date"]."</td>
                                            <td>" . $row["product_title"]. "</td>
                                            <td>" . $row["rent_price"]. "</td>
                                            <td>" . $row["start_date"]."</td>
                                            <td>" . $row["end_date"]."</td>
                                            <td>" . $row["status_detail"]."</td>
                                            <td>
                                            <button><a href='userViewSentRentRequest.php?cancel=".$row["rent_id"]."' Onclick='return ConfirmCancel()'>Cancel</a>"."</button>
                                            </td></tr>";
                                        }
                                        echo "</table>";
                    
                                        $qry="select * from rent_request where user_id='$user_id'";
                                        $result=$con->query($qry);
                                        $total_page=ceil(($result->num_rows/$num_rec_per_page));
                                        echo "<ul class='pagination'>";
                                        for ($i=1; $i<=$total_page; $i++) 
                                        { 
                                            echo"<li><a href='?pg=".$i."'>".$i."</li>";
                                        }
                                        echo"</ul>";
                                    } else {
                                        echo "<h4>No Rent Request has been sent.<h4>";
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