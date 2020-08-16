<?php
include("include/db.php");
session_start();
if(!isset($_SESSION["uid"])){
    header("location:index.php");

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
<body>
<?php include("include/wheader.php"); ?>
<?php include("include/ssidebar.php"); ?>
<div id="page-wrapper">
    <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Control Board</h1>
                </div>
            </div>
            <div class="row">
            
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-dropbox fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php
                                    	$user_id = $_SESSION["uid"];
                                        $sql = "SELECT * FROM `products` where user_id = $user_id";
                                        $dbStatus = $con->query($sql);
                                        $numberOfProducts = mysqli_num_rows($dbStatus);
                                        ?>
                                        <div class="huge"><?php echo $numberOfProducts; ?></div>
                                        <div>Total of Products</div>
                                    </div>
                                </div>
                            </div>
                            <a href="userViewProduct.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-exchange fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <?php
                                        $sql = "SELECT * FROM `exchange_request` where exchanger_id = $user_id";
                                        $dbStatus = $con->query($sql);
                                        $numberOfRequest= mysqli_num_rows($dbStatus);
                                        ?>
                                        <div class="huge"><?php echo $numberOfRequest; ?></div>
                                    <div>Total of Exchange Request</div>
                                </div>
                            </div>
                        </div>
                        <a href="userViewReceivedExchangeRequest.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-calendar-check-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php
                                        $sql = "SELECT * FROM `rent_request` where renter_id = $user_id";
                                        $dbStatus = $con->query($sql);
                                        $numberOfRequest = mysqli_num_rows($dbStatus);
                                        ?>
                                        <div class="huge"><?php echo $numberOfRequest; ?></div>
                                        <div>Total of Rent Request</div>
                                    </div>
                                </div>
                            </div>
                            <a href="userViewReceivedRentRequest.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-copy fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                <?php
                                        $sql = "SELECT a.order_id,a.qty,a.trx_id,a.creation_date,a.p_status,b.first_name,c.product_title,c.user_id FROM orders as a left join user_info as b on a.user_id=b.user_id left join products as c on a.product_id=c.product_id  WHERE c.user_id='$user_id' ";
                                        $dbStatus = $con->query($sql);
                                        $numberOfReport = mysqli_num_rows($dbStatus);
                                        ?>
                                        <div class="huge"><?php echo $numberOfReport; ?></div>
                                    <div>Total of Sales Report</div>
                                </div>
                            </div>
                        </div>
                        <a href="userViewSalesReport.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
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
