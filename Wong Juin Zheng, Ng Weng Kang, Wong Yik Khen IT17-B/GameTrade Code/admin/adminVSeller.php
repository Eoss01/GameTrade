<?php
session_start();

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>GameTrade Admin Controller</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/metisMenu.min.css" rel="stylesheet">

    <link href="css/timeline.css" rel="stylesheet">
    <link href="css/startmin.css" rel="stylesheet">
    <link href="css/morris.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<style>
			table tr td {padding:10px;}
		</style>
	</head>
<body>
<?php include("include/header.php"); ?>
<?php include("include/sidebar.php"); ?>
	<div class="container-fluid">
    <div id="page-wrapper">
    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Seller Details</h1>
                </div>
            </div>
            <div class="panel-body">
            <div class="panel-body">
						<?php
							include_once("include/config.php");
							$sellerID = $_GET['seller'];
							$user_list = "SELECT * FROM user_info WHERE user_id='$sellerID'";
							$query = mysqli_query($db,$user_list);
							if (mysqli_num_rows($query) > 0) {
								while ($row=mysqli_fetch_array($query)) {
									?>
										<div class="row" >
											<div class="col-md-6">
												<table>
													<tr><td>First Name:</td><td><b><?php echo $row["first_name"]; ?></b> </td></tr>
													<tr><td>Last Name:</td><td><b><?php echo $row["last_name"]; ?></b></td></tr>
													<tr><td>Paypal Email:</td><td><b><?php echo $row["email"]; ?></b></td></tr>
                                                    <tr><td>Mobile:</td><td><b><?php echo $row["mobile"]; ?></b></td></tr>
													<tr><td>Address:</td><td><b><?php echo $row["address"]; ?></b></td></tr>
                                                    <tr><td>Registration Date:</td><td><b><?php echo $row["regDate"]; ?></b></td></tr>
													<tr><td><button class="pull-left" data-toggle="modal"><i class="fa fa-plus-circle"><a href="adminVOrder.php"></i>Back</a></button>
</b></td></tr>
												</table>
											</div>
                                            <div>
									<?php
								}
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