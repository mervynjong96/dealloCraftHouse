<!DOCTYPE html>
<html>
	<head>
		 <title>eMarketplace Portal System</title>		
        <?php 
            include_once "./include/Header.php";
            if(!isset($_SESSION))
                session_start();

            if(!isset($_SESSION["login_user"]))
                header("location:index.php");	
        ?>
	</head>
	
	<body>	
		<?php include_once "./include/NavigationBar.php" ?>
		
		<div class="content">
			<div class="container">
				<p class="invalidMsg"> 
					<?php 
						if (isset($_SESSION["invalid_message"]))
						 {
                            echo $_SESSION["invalid_message"];
                            unset ($_SESSION["invalid_message"]);
						 }
					?> 
                </p>
				<?php include_once "process/list_cart_process.php" ?>
			</div>
		</div>
		
		<?php include_once "./include/Footer.php" ?>
		
		<script>
			// if cart is not empty then prefilled the total with 0.00
			if(document.getElementById("total_price") !== null)
            {
				var typeTimeout;			
				var total = parseFloat(0).toFixed(2) ;
				document.getElementById("total_price").innerHTML=total;
			}
			
			// remove items by updating through ajax and reload if expected result is returned
			// expected result:Remove item successfully
			function removeItem(product_id)
            {
				webix.confirm({
                   text:"Do you want to remove this item fom your cart?", 
                   width:500,
                   type:"alert-error",
                   callback: function(result){
                        if(result){
                            webix.ajax().post("process/remove_item_from_cart_process.php",{remove_product_id:product_id},
                            function(text,data){
                                if(text=="Remove item successfully"){
                                 webix.alert({
                                        text:"The item has been removed from your cart list successfully",
                                        width:450,
                                        callback: function(result){
                                            location.reload();
                                        }
                                    });
                                }
                            })
                        }
                   }
				});
			}
			
			//Decrease the item quantity value and run the update within 1 second
			//button is disabled if item quantity reached 1
			function minusQuantity(product_id,button_id,maxQuantity)
            {
				clearTimeout(typeTimeout);                
                
                var field_id = "product_quantity_" + product_id;
                var input_field = $("input[name='"+ field_id + "']");
                var currentVal = parseInt(input_field.val());

                currentVal--;
                var minBtn = document.getElementById("minus_button_"+product_id);
                if( currentVal <= 1 )
                    minBtn.setAttribute("disabled",true);
                else
                    minBtn.removeAttribute("disabled");
                
                input_field.val(currentVal);
                
				typeTimeout = setTimeout(function() {                    
				    runUpdate(product_id,currentVal,maxQuantity);                    
                }, 1000);
                
			}
			
			
			//Increase the item quantity value and run the update within 1 second
			//button is disabled if maximum quantity is reached
			function addQuantity(product_id,button_id,maxQuantity)
            {
				clearTimeout(typeTimeout);
                
				var field_id = "product_quantity_" + product_id;
				var input_field = $("input[name='"+ field_id + "']");
				var currentVal = parseInt(input_field.val());
<<<<<<< HEAD
				//alert(-(maxQuantity - currentVal))  
=======
                
>>>>>>> origin/master
                currentVal++;
                var addBtn = document.getElementById("plus_button_"+product_id);
                if(-(maxQuantity - currentVal) >= maxQuantity)
                    addBtn.setAttribute("disabled",true);
                else
                    addBtn.removeAttribute("disabled");
                
                input_field.val(currentVal);
                
				typeTimeout = setTimeout(function() {
				    runUpdate(product_id,currentVal,maxQuantity);                    
                }, 1000);
                
			}
			
			//check if its numeric value before run the update script
			function updateInput(field_id,product_id,maxQuantity)
            {				
				var input_field = $("input[name='"+ field_id +"']");
				var currentVal = parseInt(input_field.val());
				var minus_button = document.getElementById("minus_button_"+product_id);
				var plus_button =  document.getElementById("plus_button_"+product_id);
				                
                if(Number.isInteger(currentVal))
                    runUpdate(product_id,currentVal,maxQuantity);
                else
                    document.getElementsByClassName("invalidMsg")[0].innerHTML= "Only integers and numeric value are allowed";                
			}
			
			
			//detect when user has stop typing with 1 second and perform checking 
			function checkFinishTyping(field_id,product_id,maxQuantity)
            {
				var input_field = $("input[name='"+ field_id +"']");
				clearTimeout(typeTimeout);			
				typeTimeout = setTimeout(function(){updateInput(field_id,product_id,maxQuantity)}, 1000);				
			}
			
			//Perform ajax action and return server response text
			function runUpdate(product_id,currentValue,maxQuantity)
            {
				webix.ajax().post("process/updated_item_in_cart_process.php",{ edit_product_id:product_id, new_quantity:currentValue, max_quantity:maxQuantity },
                    function(text,data){
                        location.reload();								
                })
			}			
			
			// sum all the price of checked item in the cart
			//expected result: the total value is equal to the sum of price of all checked item
			function sumTotal(value,product_id)
            {
                // Count the number of checked item
                var count = 0;
                $(":checkbox").each(function () {
                    var ischecked = $(this).is(":checked");
                    if (ischecked) {
                        count++;
                    }
                });
                
                // Disable checkout button if no item is checked, else, enable checkout button
                if(count > 0)
                    document.getElementById("checkoutBtn").removeAttribute("disabled");
                else
                    document.getElementById("checkoutBtn").setAttribute("disabled",true);
                
				if(document.getElementById(product_id).checked)
                {
					total = (parseFloat(total) + parseFloat(value)).toFixed(2);
					document.getElementById("total_price").innerHTML=total;
				}
                else
                {
					total = (parseFloat(total) - parseFloat(value)).toFixed(2);
					document.getElementById("total_price").innerHTML=total;
				}
			}
            
			// send the selected item id to the checkout.php 
			function checkout()
            {
                // Get selected item ID
                var checkedItemID = [];
                $(":checkbox").each(function () {
                    var ischecked = $(this).is(":checked");
                    if (ischecked) {
                        checkedItemID.push($(this)[0].name);
                    }
                });
                
                console.log(checkedItemID);                
                
                // And POST the selected item ID and redirect to checkout page
                webix.send('checkout.php', { checkedItemID: JSON.stringify(checkedItemID) }, "post");
			}
		</script>		
	</body>
</html>
