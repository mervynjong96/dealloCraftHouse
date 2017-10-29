<!DOCTYPE html>
<html>
	<head>
		 <title>eMarketplace Portal System</title>

        <?php
            include_once "./include/Header.php"
        ?>
	</head>
	
	<body>
		
		
		
		<?php
            include_once "./include/NavigationBar.php"
        ?>
		
		<div class="content">
			<div class="container">
				<div class="row">
					<div class="col-sm-2 col-xs-2 col-md-2 col-lg-2 cartHeader">
					</div>
					
					<div class="col-sm-2 col-xs-2 col-md-2 col-lg-2 cartHeader">
						Product Image
					</div>
					
					<div class="col-sm-2 col-xs-2 col-md-2 col-lg-2 cartHeader">
						Product Name
					</div>
					
					<div class="col-sm-2 col-xs-2 col-md-2 col-lg-2 cartHeader">
						Price
					</div>
					
					<div class="col-sm-2 col-xs-2 col-md-2 col-lg-2 cartHeader">
						Quantity
					</div>
					
					<div class="col-sm-2 col-xs-2 col-md-2 col-lg-2 cartHeader">
					
					</div>
				</div>
				
				<?php include_once "process/list_cart_process.php" ?>
				
				<p class='alignRight'> Total price: <span id="total_price"></span> </p>
				<p class='alignRight'> <a class='btn btn-success' style='margin-right:10px;' onClick=''>Checkout</a> </p>
			</div>
		</div>
		
		<?php
            include_once "./include/Footer.php"
        ?>
		
		<script>
			var total = parseFloat(0).toFixed(2) ;
			document.getElementById("total_price").innerHTML=total;
			
			function sumTotal(value,product_id){
				if(document.getElementById(product_id).checked){
					total = (parseFloat(total) + parseFloat(value)).toFixed(2);
					document.getElementById("total_price").innerHTML=total;
				}else{
					total = (parseFloat(total) - parseFloat(value)).toFixed(2);
					document.getElementById("total_price").innerHTML=total;
				}
			}
		</script>
		
	</body>
</html>
