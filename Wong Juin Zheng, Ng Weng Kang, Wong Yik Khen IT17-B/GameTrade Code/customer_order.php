<?php

session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
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
		<style>
			table tr td {padding:10px;}
		</style>
	</head>
<body>
<?php include("include/header.php"); ?>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading"></div>
					<div class="panel-body">
						<h1>Customer Order details</h1>
						<hr/>
						<?php
							include_once("include/db.php");
							$user_id = $_SESSION["uid"];
							$num_rec_per_page=5;
							if(isset($_GET['pg'])){
								$pg=$_GET['pg'];
							}
							else{
								$pg=1;
							}
							$startfrom=( $pg-1 ) * $num_rec_per_page;
							$orders_list = "SELECT o.order_id,o.user_id,o.product_id,o.qty,o.trx_id,o.p_status,o.creation_date,p.product_title,p.product_price,p.product_image FROM orders o,products p WHERE o.user_id='$user_id' AND o.product_id=p.product_id ORDER BY o.order_id DESC LIMIT $startfrom,$num_rec_per_page";
							$query = mysqli_query($con,$orders_list);

							if (mysqli_num_rows($query) > 0) {
								while ($row=mysqli_fetch_array($query)) {
									?>
										<div class="row">
											<div class="col-md-6">
												<img style="width:180px; height:250px;" src="product_images/<?php echo $row['product_image']; ?>" class="img-responsive img-thumbnail" />
											</div>
											<div class="col-md-6">
												<table>
													<tr><td>Product Name</td><td><b><?php echo $row["product_title"]; ?></b> </td></tr>
													<tr><td>Product Price</td><td><b><?php echo "$ ".$row["product_price"]; ?></b></td></tr>
													<tr><td>Quantity</td><td><b><?php echo $row["qty"]; ?></b></td></tr>
													<tr><td>Transaction Id</td><td><b><?php echo $row["trx_id"]; ?></b></td></tr>
													<tr><td>Order Date</td><td><b><?php echo $row["creation_date"]; ?></b></td></tr>

												</table>
											</div>
										</div>
									<?php
								}
								$orders_list = "SELECT * FROM orders WHERE user_id='$user_id'";
								$result=$con->query($orders_list);
								$total_page=ceil(($result->num_rows/$num_rec_per_page));
								echo "<ul class='pagination'>";
								for ($i=1; $i<=$total_page; $i++) 
								{ 
									echo"<li><a href='?pg=".$i."'>".$i."</li>";
								}
								echo"</ul>";
							} else {
								echo "<h4>No Order Record.<h4>";
							}
						?>
						
					</div>
					<div class="panel-footer"></div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</body>
</html>
















































