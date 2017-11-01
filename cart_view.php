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
				
				if(session_id() == "")
					session_start();
				
				if(!isset($_SESSION["login_user"])){
					header("location:index.php");
				}
		?>
		
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
			
			var typeTimeout;
			
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
			
			function removeItem(product_id){
				webix.confirm("Do you want to remove this item fom your cart?", function(result){
					if(result){
							webix.ajax().post("process/remove_item_from_cart_process.php",{remove_product_id:product_id},
							function(text,data){
								alert(text);

								if(text=="Remove item successfully"){
									location.reload();
								}
							})

					}
				});
			}
			
			function minusQuantity(product_id,button_id,maxQuantity){
				var field_id = "product_quantity_" + product_id;
				var input_field = $("input[name='"+ field_id + "']");
				var currentVal = parseInt(input_field.val());
				var plus_button = document.getElementById("plus_button_"+product_id);
								
				if(currentVal>1){
					currentVal--;
					input_field.val(currentVal);
					if(plus_button.disabled){
						plus_button.disabled = false;
					}
				}
				
				if(currentVal <=1){
					document.getElementById(button_id).disabled = true;
				}
				
				updateInput(field_id,product_id,maxQuantity);
			}
			
			function addQuantity(product_id,button_id,maxQuantity){
				var field_id = "product_quantity_" + product_id;
				var input_field = $("input[name='"+ field_id + "']");
				var currentVal = parseInt(input_field.val());
				var minus_button = document.getElementById("minus_button_"+product_id);
								
				if(currentVal<maxQuantity){
					currentVal++;
					input_field.val(currentVal);
					if(minus_button.disabled){
						minus_button.disabled = false;
					}
				}
				
				if(currentVal >=maxQuantity){
					document.getElementById(button_id).setAttribute("disabled",true);
				}
				
				updateInput(field_id,product_id,maxQuantity);
			}
			
			function updateInput(field_id,product_id,maxQuantity){
				
				var input_field = $("input[name='"+ field_id +"']");
				var currentVal = parseInt(input_field.val());
				
				
				if(Number.isInteger(currentVal)){
					if(currentVal < 1){
						currentVal = 1;
						input_field.val(currentVal);
					}else if(currentVal > maxQuantity){
						currentVal = maxQuantity;
						input_field.val(currentVal);
					}else if(currentVal >= 1 && currentVal <=maxQuantity){
						webix.ajax().post("process/updated_item_in_cart_process.php",{edit_product_id:product_id,new_quantity:currentVal},
							function(text,data){
								alert(text);
								if(text=="Update item quantity successfully"){
									location.reload();
								}
						})
					}
				}else{
					alert("Only numeric and integer are accepted");
				}
			}
			
			function checkFinishTyping(field_id,product_id,maxQuantity){
			
				
				var input_field = $("input[name='"+ field_id +"']");
				clearTimeout(typeTimeout);
			
				typeTimeout = setTimeout(function(){updateInput(field_id,product_id,maxQuantity)}, 1000);
				
			}
		</script>
		
	</body>
</html>
