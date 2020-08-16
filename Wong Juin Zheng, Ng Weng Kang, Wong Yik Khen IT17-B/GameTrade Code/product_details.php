<?php
include("include/db.php");
include("action.php");

$prodID = $_GET['prodid'];

if(!empty($prodID)){
		$sql = "SELECT * FROM products WHERE product_id = '$prodID'";
		$run_query = mysqli_query($con,$sql);
		$getProdInfo = mysqli_fetch_array($run_query);
        $pro_id=$getProdInfo["product_id"];
        $user_id=$getProdInfo["user_id"];
		$pro_title = $getProdInfo["product_title"];
        $pro_price = $getProdInfo['product_price'];
        $pro_bprice = $getProdInfo['product_bprice'];
		$pro_image = $getProdInfo["product_image"];
		$pro_quantity = $getProdInfo["product_quantity"];
		$pro_stype = $getProdInfo['product_stype'];
}


$ratingDetails = "SELECT ratingNumber FROM item_rating WHERE itemId = '$prodID'";
$rateResult = mysqli_query($con, $ratingDetails) or die("database error:". mysqli_error($con));
$ratingNumber = 0;
$count = 0;
$fiveStarRating = 0;
$fourStarRating = 0;
$threeStarRating = 0;
$twoStarRating = 0;
$oneStarRating = 0;

while($rate = mysqli_fetch_assoc($rateResult)) {
	$ratingNumber+= $rate['ratingNumber'];
	$count += 1;
	if($rate['ratingNumber'] == 5) {
		$fiveStarRating +=1;
	} else if($rate['ratingNumber'] == 4) {
		$fourStarRating +=1;
	} else if($rate['ratingNumber'] == 3) {
		$threeStarRating +=1;
	} else if($rate['ratingNumber'] == 2) {
		$twoStarRating +=1;
	} else if($rate['ratingNumber'] == 1) {
		$oneStarRating +=1;
	}
}

$average = 0;
if($ratingNumber && $count) {
	$average = $ratingNumber/$count;
}	


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>GameTrade</title>
    <script src="js/rating.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/rating.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/startmin.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
</style>
<body>
<?php if(!isset($_SESSION["uid"])){
	include("include/fheader.php");
}else{
    include("include/header.php");
}?>
    <p><br/></p>


	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-body">
						<h1>Product Details</h1>
						<hr/>
                        <div class="col-md-12 col-xs-12" id="product_msg">
					</div>
						<div class="col-sm-5">
                            <div class="view-product">
                                <p></p>

                                <img src="product_images/<?php echo $pro_image; ?>" width="225px;" height="300px;"
                                    style="float:left;">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="product-information">
                                <!--/product-information-->
                                <h3 class="product"><b>
                                        <?php echo $pro_title; ?></b></h3>
                                <br>
                                <h4><b>Discount Price: </b> $<span class="price">
                                        <?php echo $pro_price; ?></span></h4>

                                <h5><b>Original Price: $</b><s><span class="price"><?php echo $pro_bprice; ?></s></h5>                
                                <p><b>Sell Types: </b>
                                    <?php echo $pro_stype; ?>
                                </p>
        
                                <p><b>Quantity: </b>
                                    <?php echo $pro_quantity; ?>
                                </p>
                                <p><button pid='<?php echo $pro_id; ?>' id='product' class='btn btn-success btn-sm'>Add To Cart</button></p>
                                <p></p>

                                <button class='btn btn-success btn-sm' id="myBtn">Seller Information</button>
                                <div id="myModal" class="modal">
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <?php
							include_once("include/db.php");
							$sellerID = $user_id;
							$user_list = "SELECT * FROM user_info WHERE user_id='$sellerID'";
							$query = mysqli_query($con,$user_list);
							if (mysqli_num_rows($query) > 0) {
								while ($row=mysqli_fetch_array($query)) {
									?>
										<div class="row" >
											<div class="col-md-6">
												<table>
													<tr><td>First Name:</td><td><b><?php echo $row["first_name"]; ?></b></td></tr>

													<tr><td>Last Name:</td><td><b><?php echo $row["last_name"]; ?></b></td></tr>
                                                    
													<tr><td>Email:</td><td><b><?php echo $row["email"]; ?></b></td></tr>

                                                    <tr><td>Mobile:</td><td><b><?php echo $row["mobile"]; ?></b></td></tr>

													<tr><td>Address:</td><td><b><?php echo $row["address"]; ?></b></td></tr>

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
                                <p></p>
                                <?php if(!isset($_SESSION["uid"])){
	                            
                                }else{
                                    include("include/rate_button.php");
}?>
                        </div>
														</div>



		
		<div id="ratingDetails"  >
                    <div class="row">
                        <div class="col-sm-10">
							<h2>Rating & Reviews of <?php echo $pro_title; ?></h2>
														
                            <h1 class="bold padding-bottom-7">
                                <?php printf('%.1f', $average); ?> <small>/ 5</small></h1>
                            <?php

			$averageRating = round($average, 0);
			for ($i = 1; $i <= 5; $i++) {
				$ratingClass = "btn-default btn-grey";
				if($i <= $averageRating) {
					$ratingClass = "btn-warning";
				}
			?>
                            <button type="button" class="btn btn-sm <?php echo $ratingClass; ?>" aria-label="Left Align">
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                            </button>
                            <?php } ?>
                        </div>
                        <div class="col-sm-3">
                            <?php
			$fiveStarRatingPercent = round(($fiveStarRating/5)*100);
			$fiveStarRatingPercent = !empty($fiveStarRatingPercent)?$fiveStarRatingPercent.'%':'0%';	
			
			$fourStarRatingPercent = round(($fourStarRating/5)*100);
			$fourStarRatingPercent = !empty($fourStarRatingPercent)?$fourStarRatingPercent.'%':'0%';
			
			$threeStarRatingPercent = round(($threeStarRating/5)*100);
			$threeStarRatingPercent = !empty($threeStarRatingPercent)?$threeStarRatingPercent.'%':'0%';
			
			$twoStarRatingPercent = round(($twoStarRating/5)*100);
			$twoStarRatingPercent = !empty($twoStarRatingPercent)?$twoStarRatingPercent.'%':'0%';
			
			$oneStarRatingPercent = round(($oneStarRating/5)*100);
			$oneStarRatingPercent = !empty($oneStarRatingPercent)?$oneStarRatingPercent.'%':'0%';
			
			
						?>
                            <div class="pull-left" >
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">5 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5"
                                            aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $fiveStarRatingPercent; ?>">
                                            <span class="sr-only">
                                                <?php echo $fiveStarRatingPercent; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;">
                                    <?php echo $fiveStarRating; ?>
                                </div>
                            </div>

                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">4 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4"
                                            aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $fourStarRatingPercent; ?>">
                                            <span class="sr-only">
                                                <?php echo $fourStarRatingPercent; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;">
                                    <?php echo $fourStarRating; ?>
                                </div>
                            </div>
                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">3 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3"
                                            aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $threeStarRatingPercent; ?>">
                                            <span class="sr-only">
                                                <?php echo $threeStarRatingPercent; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;">
                                    <?php echo $threeStarRating; ?>
                                </div>
                            </div>
                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">2 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2"
                                            aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $twoStarRatingPercent; ?>">
                                            <span class="sr-only">
                                                <?php echo $twoStarRatingPercent; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;">
                                    <?php echo $twoStarRating; ?>
                                </div>
                            </div>
                            <div class="pull-left">
                                <div class="pull-left" style="width:35px; line-height:1;">
                                    <div style="height:9px; margin:5px 0;">1 <span class="glyphicon glyphicon-star"></span></div>
                                </div>
                                <div class="pull-left" style="width:180px;">
                                    <div class="progress" style="height:9px; margin:8px 0;">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1"
                                            aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $oneStarRatingPercent; ?>">
                                            <span class="sr-only">
                                                <?php echo $oneStarRatingPercent; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pull-right" style="margin-left:10px;">
                                    <?php echo $oneStarRating; ?>
                                </div>
                            </div>
                        </div>
                    </div>





                    <div class="row">
                        <div class="col-sm-12">
                            <hr />
                            <div class="review-block">
                                <?php
                                $prodID = $_GET['prodid'];
				$ratinguery = "SELECT ratingId, itemId, userId, username, ratingNumber, title, comments, created, modified FROM item_rating  WHERE itemId = '$prodID'";
				$ratingResult = mysqli_query($con, $ratinguery) or die("database error:". mysqli_error($con));
				while($rating = mysqli_fetch_assoc($ratingResult)){
                    date_default_timezone_set('UTC');
                    $date=date_create($rating['created']);
                    $reviewDate = date_format($date,"M d, Y");
                    
		
				?>
                                <div class="row">
                                    <div class="col-sm-4">
										<?php ?>
                                        

                                        <div class="review-block-name" style=" font-size: 150%;">By <?php echo $rating['username']; ?><a href="#">
                                        </a></div>
                                        <div class="review-block-date" style=" font-size: 100%;">
                                            <?php echo $reviewDate; ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="review-block-rate">
                                            <?php
								for ($i = 1; $i <= 5; $i++) {
									$ratingClass = "btn-default";
									if($i <= $rating['ratingNumber']) {
										$ratingClass = "btn-warning";
									}
								?>
                                            <button type="button" class="btn btn-xs <?php echo $ratingClass; ?>"
                                                aria-label="Left Align">
                                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                            </button>
                                            <?php } ?>
                                        </div>
                                        <div class="review-block-title" style=" font-size: 100%;">
                                            <?php echo $rating['title']; ?>
                                        </div>
                                        <div class="review-block-description" style=" font-size: 100%;">
                                            <?php echo $rating['comments']; ?>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>



                
                <div id="ratingSection" style="display:none;">
                    <div class="row">
                        <div class="col-sm-12">
                            <form id="ratingForm" method="POST">
                                <div class="form-group">
                                    <h4>Rate this product</h4>
                                    <button type="button" class="btn btn-warning btn-sm rateButton" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    </button>
                                    <input type="hidden" class="form-control" id="rating" name="rating" value="1">
                                    <input type="hidden" class="form-control" id="itemId" name="itemId" value="<?php echo $prodID?>">
                                </div>
                                <div class="form-group">
                                    <label for="usr">Title*</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Comment*</label>
                                    <textarea class="form-control" rows="5" id="comment" name="comment" required></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info" id="saveReview">Save Review</button>
                                    <button type="button" class="btn btn-info" id="cancelReview">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
 </div>               

</body>

</html>
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>