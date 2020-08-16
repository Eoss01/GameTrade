<?php
include("include/config.php");
include("action.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>GameTrade</title>

		<script src="js/jquery2.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
		<link rel="stylesheet" href="css/style.css">
		<link href="css/bootstrap.css" rel="stylesheet">
    	<link href="css/startmin.css" rel="stylesheet">
   	    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

	</head>
<body>
<?php include("include/header.php"); ?>

	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2 col-xs-12">
				<div id="get_category">
				</div>
				<div id="get_brand">
				</div>
			</div>
			<div class="col-md-8 col-xs-12">
				<div class="row">
					<div class="col-md-12 col-xs-12" id="product_msg">
					</div>
				</div>
				<div class="panel panel-info">
					<div class="panel-heading">Products</div>
					<div class="panel-body">
						<div id="get_product">
						</div>
					</div>
					<div class="panel-footer">&copy; 2018 GameTrade</div>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
</body>
</html>
















































