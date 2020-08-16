<?php
include("include/config.php");
session_start();

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
                    <h1 class="page-header">Manage Report</h1>
                </div>
            </div>
            <div class="panel-body">
            <form name="search" action="adminVReport.php" method="POST">
            <input type="submit" name="searchbtn" value="Search" style="float: right;"/>
            <input name="search" id="search" type="text" style="float: right;" />
                                <div class="dataTable_wrapper">
                                    <?php
                                    $search="";

                                     if (!isset($_GET['page'])) {
                                         $page = 1;
                                       } else {
                                         $page = $_GET['page'];
                                       }
                                     $this_page_first_result = ($page-1)*$results_per_page;
                                     $sql='SELECT * FROM reports LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
                                     $result = mysqli_query($db, $sql);

                                    if ($result->num_rows > 0) {
                                        echo "<table class='table table-striped table-bordered table-hover' id='dataTables-example'><form name='form2' method='post' action='adminVReport.php'><tr><th>Sales Date</th><th>Customer</th><th>Total Perchase</th><th>Action</th></tr>";
                
                                        echo "</table>";
                                    } else {
                                        echo "0 results";
                                    }
                                        ?>
                                        <?php

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
