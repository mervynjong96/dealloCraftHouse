<!--
    Document:		product_details.php
    Author: 		Aethylwyne
    Created: 		10/7/2017
    Last Modified: 	10/10/2017

    reminder: data-ng-app=""
-->

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
        
        <?php
            // get method retrieves from database
            $id = $_GET["id"];
        
            require "process/db_conn.php";

            $offset = 0;
            $query = mysqli_query($conn, "SELECT * FROM products WHERE product_id = $id");
            $product = mysqli_fetch_array($query);
        ?>
        
        <div class="content">
            <div class="container">
                
                <div class="well productdetail">
                    <img class="img-responsive" src="
                        <?php
                            $directory = "./assets/images/products/" . $product["product_id"];
                            $images = glob("$directory/*.{jpg,png,bmp}", GLOB_BRACE);

                            foreach($images as $image)
                            {
                                echo $image;
                                break;
                            }
                        ?>" alt="Picture of <?php echo $product["product_name"]; ?>" />
                    <div>
                        <h2><?php echo $product["product_name"]; ?></h2>
                        <p>
                            Reviews: 
                            <?php
                                if ($product["product_rating"] == 5) {
                                    for ($i = 0; $i < 5; $i++) {
                                        echo "<span class='glyphicon glyphicon-star'></span>";
                                    }
                                } else if ($product["product_rating"] >= 4) {
                                    for ($i = 0; $i < 4; $i++) {
                                        echo "<span class='glyphicon glyphicon-star'></span>";
                                    }
                                    echo "<span class='glyphicon glyphicon-star-empty'></span>";
                                } else if ($product["product_rating"] >= 3) {
                                    for ($i = 0; $i < 3; $i++) {
                                        echo "<span class='glyphicon glyphicon-star'></span>";
                                    }
                                    echo "<span class='glyphicon glyphicon-star-empty'></span>";
                                    echo "<span class='glyphicon glyphicon-star-empty'></span>";
                                } else if ($product["product_rating"] >= 2) {
                                    echo "<span class='glyphicon glyphicon-star'></span>";
                                    echo "<span class='glyphicon glyphicon-star'></span>";
                                    for ($i = 0; $i < 3; $i++) {
                                        echo "<span class='glyphicon glyphicon-star-empty'></span>";
                                    }
                                } else if ($product["product_rating"] >= 1) {
                                    echo "<span class='glyphicon glyphicon-star'></span>";
                                    for ($i = 0; $i < 4; $i++) {
                                        echo "<span class='glyphicon glyphicon-star-empty'></span>";
                                    }
                                } else {
                                    for ($i = 0; $i < 5; $i++) {
                                        echo "<span class='glyphicon glyphicon-star-empty'></span>";
                                    }
                                }
                                echo " " . $product["product_rating"];
                            ?>
                        </p>
                        <p><?php echo $product["product_desc"]; ?></p>
                        
                        <h3>Size & Colors</h3>
                        <p>Weight of Product: <?php echo $product["product_weight"]; ?>kg</p>
                        
                        <h3>Shipping & Policies</h3>
                        <p>
                            <?php echo $product["product_policy"]; ?>
                        </p>
                        
                        <h3>Price</h3>
                        <p>$<?php echo $product["product_price"]; ?> </p>
                        
						<h3>Quantity</h3>
						<?php
						echo "<div class='input-group'>
							<span class='input-group-btn'>
								  <button type='button' class='btn btn-default btn-number' id='minus_button_" . $product['product_id'] . "' onclick='minusQuantity(". $product['product_id'] .",this.id,". $product["product_stockQty"] . ")'>
									  <span class='glyphicon glyphicon-minus'</span>
								  </button>
          					</span>
        						  <input type='text' class='form-control input-number' name='product_quantity_".$product['product_id'] . "' value='0' onkeydown='checkFinishTyping(this.name,". $product['product_id'] .",". $product["product_stockQty"] . ")'/>
         					 <span class='input-group-btn'>
								  <button type='button' class='btn btn-default btn-number'  id='plus_button_" . $product['product_id'] . "' onclick='addQuantity(". $product['product_id'] .",this.id,". $product["product_stockQty"] . ")'>
									  <span class='glyphicon glyphicon-plus'></span>
								  </button>
          					</span>
						</div>";
						?>
						<p><a class="btn btn-success" href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart</a></p>
                        <p>Tags: <em><?php echo $product["product_tag"]; ?></em></p>
                    </div>
                </div>
                
                <div class="well">
                    <div class="text-right">
                        <a class="btn btn-info">Write a Review</a>
                    </div>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h4>Anonymous - 10/10/2017</h4>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h4>Anonymous - 10/10/2017</h4>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
        <?php
            include_once "./include/Footer.php"
        ?>
		
		<script>
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
				//var plus_button = document.getElementById("plus_button_"+product_id);
								
				//if(currentVal>1){
					currentVal--;
					input_field.val(currentVal);
					/*if(plus_button.disabled){
						plus_button.disabled = false;
					}*/
				//}
				
				/*if(currentVal <=1){
					document.getElementById(button_id).disabled = true;
				}*/
				
				//updateInput(field_id,product_id,maxQuantity);
				runUpdate(product_id,currentVal,maxQuantity);
			}
			
			function addQuantity(product_id,button_id,maxQuantity){
				var field_id = "product_quantity_" + product_id;
				var input_field = $("input[name='"+ field_id + "']");
				var currentVal = parseInt(input_field.val());
				var minus_button = document.getElementById("minus_button_"+product_id);
								
				//if(currentVal<maxQuantity){
					currentVal++;
					input_field.val(currentVal);
					/*if(minus_button.disabled){
						minus_button.disabled = false;
					}*/
				//}
				
				/*if(currentVal >=maxQuantity){
					document.getElementById(button_id).disabled  = true;
					
				}*/
				
				//updateInput(field_id,product_id,maxQuantity);
				runUpdate(product_id,currentVal,maxQuantity);
			}
			
			function updateInput(field_id,product_id,maxQuantity){
				
				var input_field = $("input[name='"+ field_id +"']");
				var currentVal = parseInt(input_field.val());
				var minus_button = document.getElementById("minus_button_"+product_id);
				var plus_button =  document.getElementById("plus_button_"+product_id);
				
				/*if(Number.isInteger(currentVal)){
					if(currentVal < 1){
						currentVal = 1;
						input_field.val(currentVal);
						runUpdate(product_id,currentVal,maxQuantity);
						if(plus_button.disabled){
							plus_button.disabled = false;
						}
						
						minus_button.disabled = true;
						
						
						
					}else if(currentVal > maxQuantity){
						
						runUpdate(product_id,currentVal,maxQuantity);
					
					}else if(currentVal >= 1 && currentVal <=maxQuantity){
						
						runUpdate(product_id,currentVal,maxQuantity);
						
					}
				}*/
				
				runUpdate(product_id,currentVal,maxQuantity);
			}
			
			
			//detect when user has stop typing with 1 second and perform checking 
			function checkFinishTyping(field_id,product_id,maxQuantity){
			
				
				var input_field = $("input[name='"+ field_id +"']");
				clearTimeout(typeTimeout);
			
				typeTimeout = setTimeout(function(){updateInput(field_id,product_id,maxQuantity)}, 1000);
				
			}
			
			//Perform ajax action and return server response text
			function runUpdate(product_id,currentValue,maxQuantity){
				webix.ajax().post("process/updated_item_in_cart_process.php",{edit_product_id:product_id,new_quantity:currentValue,max_quantity:maxQuantity},
							function(text,data){
								
								
									location.reload();
								
						})
			}
		</script>
    </body>
</html>