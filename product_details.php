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
                
				<span id="resultAdd"></span>
				
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
                        ?>" style='width:400px;height:400px;' alt="Picture of <?php echo $product["product_name"]; ?>" />
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
                        
                        <h3>Size &amp; Colors</h3>
                        <p>Weight of Product: <?php echo $product["product_weight"]; ?>kg</p>
                        
                        <h3>Shipping &amp; Policies</h3>
                        <p>
                            <?php echo $product["product_policy"]; ?>
                        </p>
                        
                        <h3>Price</h3>
                        <p>$<?php echo $product["product_price"]; ?> </p>
                        <?php
							
							if(isset($_SESSION["login_user"])){?>
							
								
							<h3>Quantity</h3>
						<p><?php 
						echo "<div class='input-group' style='width:200px'>
							<span class='input-group-btn'>
								  <button type='button' class='btn btn-default btn-number' id='minus_button_" . $product['product_id'] . "' onclick='minusQuantity(". $product['product_id'] .",this.id,". $product["product_stockQty"] . ")'>
									  <span class='glyphicon glyphicon-minus'</span>
								  </button>
          					</span>
        						  <input type='text' class='form-control input-number' name='product_quantity_".$product['product_id'] . "' style='width:200px' value='0' onkeydown='checkFinishTyping(this.name,". $product['product_id'] .",". $product["product_stockQty"] . ")'/>
         					 <span class='input-group-btn'>
								  <button type='button' class='btn btn-default btn-number'  id='plus_button_" . $product['product_id'] . "' onclick='addQuantity(". $product['product_id'] .",this.id,". $product["product_stockQty"] . ")'>
									  <span class='glyphicon glyphicon-plus'></span>
								  </button>
          					</span>
						</div>
						<p> Stock left: " . $product['product_stockQty'] . "</p>
						</p>";
							
									
								
									
								echo "<p><a class='btn btn-success' href='#' onclick='addToCart(" .$product['product_id'] . ",". $product["product_stockQty"] .")'><span class='glyphicon glyphicon-shopping-cart'></span> Add to Cart</a></p>";
							}?>
								
                        <p>Tags: <em><?php echo $product["product_tag"]; ?></em></p>
                    </div>
                </div>
                
                <div class="well">
                    <div class="text-right">
						 <?php
							
							if(isset($_SESSION["login_user"])){?>
                        <a class="btn btn-info">Write a Review</a>
						<?php } ?>
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
			function minusQuantity(product_id,maxQuantity){
				var field_id = "product_quantity_" + product_id;
				var input_field = $("input[name='"+ field_id + "']");
				var currentVal = parseInt(input_field.val());
				//var plus_button = document.getElementById("plus_button_"+product_id);
								
				if(currentVal>1){
					currentVal--;
					input_field.val(currentVal);
					/*if(plus_button.disabled){
						plus_button.disabled = false;
					}*/
				}
				
				/*if(currentVal <=1){
					document.getElementById(button_id).disabled = true;
				}*/
				
				//updateInput(field_id,product_id,maxQuantity);
				
			}
			
			function addQuantity(product_id,button_id,maxQuantity){
				var field_id = "product_quantity_" + product_id;
				var input_field = $("input[name='"+ field_id + "']");
				var currentVal = parseInt(input_field.val());
				var minus_button = document.getElementById("minus_button_"+product_id);
								
				if(currentVal<maxQuantity){
					currentVal++;
					input_field.val(currentVal);
					/*if(minus_button.disabled){
						minus_button.disabled = false;
					}*/
				}
				
				/*if(currentVal >=maxQuantity){
					document.getElementById(button_id).disabled  = true;
					
				}*/
				
				//updateInput(field_id,product_id,maxQuantity);
				
			}
			
			function addToCart(product_id,maxQuantity){
				var field_id = "product_quantity_" + product_id;
				var input_field = $("input[name='"+ field_id +"']");
				var currentVal = parseInt(input_field.val());
				
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
				
				webix.ajax().post("process/add_to_cart_process.php",{product_id:product_id,item_quantity:currentVal,max_quantity:maxQuantity},
							function(text,data){
							document.getElementById("resultAdd").innerHTML = text;
							if(text == "Item has added to the cart"){
								setTimeout(location.reload(),1000);
							}
				})
			}
			
			
			//detect when user has stop typing with 1 second and perform checking 
			function checkFinishTyping(field_id,product_id,maxQuantity){
			
				
				var input_field = $("input[name='"+ field_id +"']");
				clearTimeout(typeTimeout);
			
				typeTimeout = setTimeout(function(){addToCart(product_id,maxQuantity)}, 1000);
				
			}
			
		</script>
    </body>
</html>