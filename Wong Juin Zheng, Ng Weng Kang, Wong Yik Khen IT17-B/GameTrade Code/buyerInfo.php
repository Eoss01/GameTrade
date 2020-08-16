<?php
session_start();

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>GameTrade</title>
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
<?php 
    include("include/wheader.php");
?>
<?php 
    include("include/ssidebar.php");
?>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
	
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-default">

					<div class="panel-body">
						<h1>Buyer Information</h1>
						<hr/>
						<?php
							include_once("include/db.php");
							$buyerID = $_GET['id'];
							$user_list = "SELECT * FROM user_info WHERE user_id='$buyerID'";
							$query = mysqli_query($con,$user_list);
							if (mysqli_num_rows($query) > 0) {
								while ($row=mysqli_fetch_array($query)) {
									?>
										<div class="row" >
											<div class="col-md-6">
												<table>
													<tr><td>First Name:</td><td><b><?php echo $row["first_name"]; ?></b> </td></tr>
													<tr><td>Last Name:</td><td><b><?php echo $row["last_name"]; ?></b></td></tr>
													<tr><td>Email:</td><td><b><?php echo $row["email"]; ?></b></td></tr>
                                                    <tr><td>Mobile:</td><td><b><?php echo $row["mobile"]; ?></b></td></tr>
                                                    <tr><td>Address:</td><td><b><?php echo $row["address"]; ?></b></td></tr>
                                                    <tr><td>Registration Date:</td><td><b><?php echo $row["regDate"]; ?></b></td></tr>
													<tr><td><button class="pull-left" data-toggle="modal"><i class="fa fa-plus-circle"><a href="userViewSalesReport.php"></i>Return</a></button>
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
			<div class="col-md-2"></div>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/metisMenu.min.js"></script>
<script src="js/startmin.js"></script>
</body>
</html>