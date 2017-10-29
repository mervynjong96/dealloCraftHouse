<?php 
	session_start();
	if(isset($_SESSION["login_user"])){
		include_once "./process/count_cart_process.php";
	}
?>

<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>                        
			</button>
			<a class="navbar-brand" href="index.php">Deallo Craft House</a>
		</div>
		<div class="navbar-collapse collapse" id="myNavbar">

			<ul class="nav navbar-nav navbar-right">
				<?php 
					if(isset($_SESSION["items_in_cart"])){
						echo "<li><a href='cart_view.php'><span class='glyphicon glyphicon-shopping-cart'></span> Checkout "  . $_SESSION["items_in_cart"] ."</a></li>";

					}else{
						echo "<li><a href='cart_view.php'><span class='glyphicon glyphicon-shopping-cart'></span> Checkout </a></li>";
					}
				?>
				<li class="active"><a href="index.php">Home</a></li>
				<li><a href="products.php">Products</a></li>
				<?php
					if(isset($_SESSION["login_user"])){
						echo "<li class='dropdown'>";
						echo "<a href='#' class='userID dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'><span class='glyphicon glyphicon-user'></span> "
							. $_SESSION["login_user"] . " <span class='caret'></span> </a>";
						echo "<ul class='dropdown-menu'>";
						echo "<li><a href='profile.php'> <span class='glyphicon glyphicon-cog'> </span> My Profile </a> </li>";
						echo "<li class='divider'> </li>";
						echo "<li><a href='process/logout_process.php'> <span class='glyphicon glyphicon-log-out'> </span> Logout </a></li>";
						echo "</ul>";
						echo "</li>";
						

					}else{
						echo "<li><a href='login.php'>Login</a></li>";
						// echo "<li><a href='signup.php'>Sign Up</a></li>";
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