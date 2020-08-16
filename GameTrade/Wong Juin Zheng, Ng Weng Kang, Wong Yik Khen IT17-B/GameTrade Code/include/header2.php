<?php
session_start();
include("config.php");
?>

<div id="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="bmain.php?#"><i class="fa fa-gamepad"></i> GameTrade</a>
        </div>
        <form class="navbar-form navbar-left">
		        <div class="form-group">
		          <input type="text" class="form-control" placeholder="Search" id="search">
		        </div>
		        <button type="submit" class="btn btn-primary" id="search_btn"><span class="glyphicon glyphicon-search"></span></button>
		     </form>
		<ul class="nav navbar-right navbar-top-links">
            <li class="dropdown navbar-inverse">
                <a href="register.php">
                    <i class="fa fas fa-plus fa-fw"></i>Register
                </a>
            </li>
            <li class="dropdown navbar-inverse">
                <a href="login.php">
                    <i class="fa fa-user fa-fw"></i>Login
                </a>
            </li>
        </ul>
		
	</nav>
</div>	





