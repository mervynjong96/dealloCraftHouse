<!--
    Document:		NavigationBar.php
    Author: 		Aethylwyne
    Created: 		10/2/2017
    Last Modified: 	10/4/2017

    reminder: data-ng-app=""
-->

<?php
	session_start();
?>

<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>                        
			</button>
			<a class="navbar-brand" href="index.php">eMarketplace Portal System</a>
		</div>
		<div class="navbar-collapse collapse" id="myNavbar">

			<ul class="nav navbar-nav navbar-right">
				<li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> [0] Checkout</a></li>
				<li class="active"><a href="index.php">Home</a></li>
				<li><a href="#">Products</a></li>
				<?php
					if(isset($_SESSION["login_user"])){
						echo "<li class='userID'> Hi, " . $_SESSION["login_user"] . " </li>";
						echo "<li><a href='process/logout_process.php'> Logout </a></li>";
					
					}else{
						echo "<li><a href='login.php'>Login</a></li>";
						echo "<li><a href='signup.php'>Sign Up</a></li>";
					
					}
				?>
			</ul>

			<!-- Its not possible to change the width without using 1% for Bootstrap 3.3.7 -->
			<form class="navbar-form">
				<div class="form-group" style="display:inline;">
					<div class="input-group" style="display:table;">
						<input type="text" class="form-control" placeholder="Search">
						<div class="input-group-btn" style="width:1%;">
							<button class="btn btn-default" type="submit">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</div>
					</div>
				</div>
			</form>

		</div>
	</div>
</nav>

<!-- Sets Active tab on Nav Bar -->
<script>	
	$(document).ready(function() {
		//Get page name
		var pathname = location.pathname.split("/");
		pathname = pathname[pathname.length - 1];
		
		if(pathname !== 'index.php'){
			$('li.active').removeClass('active');
			$('a[href="' + pathname + '"]').closest('li').addClass('active'); 
		}
	});
</script>

<!-- Use this to center Brand Name instead
<div id="navigation">
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
				<a class="navbar-brand" href="#">eMarketplace Portal System</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#">Products</a></li>
					<li><a href="#">Login</a></li>
				</ul>
				<form class="navbar-form navbar-right">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search">
						<div class="input-group-btn">
							<button class="btn btn-default" type="submit">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</nav>
</div>
-->
    
