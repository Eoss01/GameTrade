<?php
session_start();
include("config.php");
?>

<div id="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="main.php?#"><i class="fa fa-gamepad"></i> GameTrade</a>
        </div>
        <form class="navbar-form navbar-left">
		        <div class="form-group">
		          <input type="text" class="form-control" placeholder="Search" id="search">
		        </div>
		        <button type="submit" class="btn btn-primary" id="search_btn"><span class="glyphicon glyphicon-search"></span></button>
		     </form>
		<ul class="nav navbar-right navbar-top-links">
            <li class="dropdown navbar-inverse">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i><?php echo $_SESSION['user'] ?><b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <!--<li><a href="userInfo.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li class="divider"></li>-->
                    <li><a href="bmain.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
            </li>
        </ul>
		
	</nav>
</div>	





