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
				
				<?php include_once "process/list_cart_process.php" ?>
				
			
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
