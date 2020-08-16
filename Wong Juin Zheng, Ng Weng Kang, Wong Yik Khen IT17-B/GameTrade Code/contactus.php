<?php
include("include/db.php");
session_start();
if(!isset($_SESSION["uid"])){
	header("location:bcontactus.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>GameTrade</title>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/main.js"></script>

		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/startmin.css" rel="stylesheet">
   	    <link href="css/font-awesome.min.css" rel="stylesheet" >
		<link href="css/font-awesome.min.css" rel="stylesheet">

	</head>
<body>
<?php include("include/wheader.php"); ?>

	<p><br/></p>
    <p><br/></p>
	<div class="container-fluid">
				<div class="panel panel-info">
					<div class="panel-heading">Contact Us</div>
					<div class="panel-body">
<p  style="text-align: center;">We are a GameTrade E-Commerce Wbsite which is selling various types of used game disc product. </p>
<p  style="text-align: center;">In here you can buy, rent or exchange our product, you can also sell you used game disc to us through using this website.</p></br></br></br>
<p  style="text-align: center;">Email: eoss01@outlook.com</p></br></br></br>
<p  style="text-align: center;">Tel/Fax: 013-7019419</p></br></br></br>




<p  style="text-align: center;">Please send your questions or requests to our email. 
<p  style="text-align: center;">If you need a quotation from us, please describe your requests and attach any photo/picture (if any) to facilitate our quotation preparation. 
<p  style="text-align: center;">We shall reply to you promptly.</p>
			
				</div>
				<div class="panel-footer">&copy; 2018 GameTrade</div>

			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
</body>
</html>

