<?php
include("include/config.php");

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
<body>
<?php include("include/header.php"); ?>
<?php include("include/sidebar.php"); ?>


    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Control Board</h1>
                </div>
            </div>
            <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-database  fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $sql = "SELECT * FROM `categories`";
                                        $dbStatus = $db->query($sql);
                                        $numberOfCategories = mysqli_num_rows($dbStatus);
                                        ?>
                                        <div class="huge"><?php echo $numberOfCategories; ?></div>
                                        <div>Total of Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="adminVCategories.php">
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
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        $sql = "SELECT * FROM `brands`";
                                        $dbStatus = $db->query($sql);
                                        $numberOfBrands = mysqli_num_rows($dbStatus);
                                        ?>
                                        <div class="huge"><?php echo $numberOfBrands; ?></div>
                                        <div>Total of Brands</div>
                                    </div>
                                </div>
                            </div>
                            <a href="adminVBrands.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-dropbox fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php
                                        $sql = "SELECT * FROM `products`";
                                        $dbStatus = $db->query($sql);
                                        $numberOfProducts = mysqli_num_rows($dbStatus);
                                        ?>
                                        <div class="huge"><?php echo $numberOfProducts; ?></div>
                                        <div>Total of Products</div>
                                    </div>
                                </div>
                            </div>
                            <a href="adminVProduct.php">
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
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php
                                        $sql = "SELECT * FROM `users`";
                                        $dbStatus = $db->query($sql);
                                        $numberOfUsers = mysqli_num_rows($dbStatus);
                                        ?>
                                        <div class="huge"><?php echo $numberOfUsers; ?></div>
                                        <div>Total of Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="adminVUser.php">
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

</div>


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/metisMenu.min.js"></script>
<script src="js/startmin.js"></script>

</body>
</html>
