<?php
session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}

if (isset($_GET["st"])) {

	$trx_id = $_GET["tx"];
		$p_st = $_GET["st"];
		$amt = $_GET["amt"];
		$cc = $_GET["cc"];
		$cm_user_id = $_GET["cm"];
	if ($p_st == "Completed") {		

		include("include/db.php");
		$sql = "SELECT a.p_id,a.qty,a.user_id,b.product_id,b.product_quantity FROM cart as a left join products as b on a.p_id=b.product_id WHERE a.user_id = '$cm_user_id'";
		$query = mysqli_query($con,$sql);   

		if (mysqli_num_rows($query) > 0) {
			while ($row=mysqli_fetch_array($query)) {
			$product_id[] = $row["p_id"];
			$qty[] = $row["qty"];
			$sproduct_id[] = $row['product_id'];
			$product_quantity[] = $row['product_quantity'];
			$quantity[] = $row['product_quantity'] - $row['qty'];
			}

			for ($i=0; $i < count($product_id); $i++) { 
				$sql = "INSERT INTO orders (user_id,product_id,qty,trx_id,p_status) VALUES ('$cm_user_id','".$product_id[$i]."','".$qty[$i]."','$trx_id','$p_st')";
				mysqli_query($con,$sql);
			}

			for ($i=0; $i < count($product_id); $i++) { 
		 		$sql="UPDATE products SET product_quantity = '".$quantity[$i]."' WHERE product_id = '".$sproduct_id[$i]."' ";
				mysqli_query($con,$sql);
				if($sql){
					$query = "DELETE FROM products WHERE product_quantity = '0'";
					mysqli_query($con,$query);
				}else{
					
				}
			}

			$sql = "DELETE FROM cart WHERE user_id = '$cm_user_id'";
			if (mysqli_query($con,$sql)) {
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
							<script src="js/main.js"></script>
							<style>
								table tr td {padding:10px;}
							</style>
						</head>
					<body>
					<?php include("include/wheader.php"); ?>
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
											<h1>Thankyou </h1>
											<hr/>
											<p>Hello <?php echo "<b>".$_SESSION["name"]."</b>"; ?> ,Your payment process is 
											successfully completed and your transaction id is <b><?php echo $trx_id; ?></b><br/>
											you can continue your Shopping <br/></p>
											<a href="index.php" class="btn btn-success btn-lg">Continue Shopping</a>
										</div>
										<div class="panel-footer"></div>
									</div>
								</div>
								<div class="col-md-2"></div>
							</div>
						</div>
					</body>
					</html>

				<?php
			}	
		}else{
			header("location:index.php");
		}
	}
}



?>
