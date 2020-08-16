<div class="wait overlay">
	<div class="loader"></div>
</div>
<div id="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php?#"><i class="fa fa-gamepad"></i> GameTrade</a>
            <a class="navbar-brand" href="bcontactus.php"><i class="fa fa-phone"></i> Contact Us</a>
        </div>


		<ul class="nav navbar-right navbar-top-links">
        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span>Cart<span class="badge">0</span></a>
        	<div class="dropdown-menu" style="width:500px;">
						<div class="panel panel-success">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-3">No.</div>
									<div class="col-md-3">Product Image</div>
									<div class="col-md-3">Product Name</div>
									<div class="col-md-3">Price.</div>
								</div>
							</div>
							<div class="panel-body">
								<div id="cart_product"></div>
							</div>
							<div class="panel-footer"></div>
						</div>
					</div>
				</li>
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><?php echo "Hi,".$_SESSION["name"]; ?></a>
				<ul class="dropdown-menu dropdown-user">
					<li><a href="customer_order.php"><i class="fa fa-sign-out fa-fw"></i> Order</a>
					<li><a href="userInfo.php"><i class="fa fa-sign-out fa-fw"></i> User Information</a>
					<li><a href="userControl.php"><i class="fa fa-sign-out fa-fw"></i> Manage Store</a>
					<li><a href="userRentControl.php"><i class="fa fa-sign-out fa-fw"></i> Rental System</a>
					<li><a href="userExchangeControl.php"><i class="fa fa-sign-out fa-fw"></i> Exchange System</a>
                    <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
				</li>
        </ul>
	</nav>
</div>