<?php
	require "db_conn.php";

	$total = 0;

	// Check if all fields are set with value
    if(  isset($_SESSION["login_user"]) )
    {
        $userid = mysqli_real_escape_string($conn, $_SESSION["login_user"]);
      
		//Count number of items in the database that matches userid
		$sql_table = "cart_product";
		$query = "SELECT COUNT(*) as items_count FROM $sql_table WHERE userid = '$userid'";
		$result = mysqli_query($conn, $query);
		$num_items = mysqli_fetch_assoc($result);
		if($num_items["items_count"] > 0) {
			
			$query = "SELECT cart_product.product_quantity,products.product_id,products.product_name,products.product_price,products.product_stockQty FROM cart_product, products WHERE cart_product.product_id = products.product_id
			 AND cart_product.userid = '$userid' ";
			$result = mysqli_query($conn, $query);
			if($result->num_rows>0){				
				echo "<div class='row'>
					<div class='col-sm-1 col-xs-1 col-md-1 col-lg-1 cartHeader'>
					</div>
					
					<div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 cartHeader'>
						Product Image
					</div>
					
					<div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 cartHeader'>
						Product Name
					</div>
					
					<div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 cartHeader'>
						Price
					</div>
					
					<div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 cartHeader'>
						Quantity
					</div>
					
					<div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 cartHeader'>
						Total Price
					</div>
					
					<div class='col-sm-1 col-xs-1 col-md-1 col-lg-1 cartHeader'>
					</div>
				</div>
				
				<hr/>";
				while($result_products = mysqli_fetch_assoc($result)){
					
					//$directory = "./assets/images/products/" . $result_products["product_id"];
				
					$img_dir          =   "./assets/images/products/" . $result_products["product_id"];
					$product_image    =   glob("$img_dir/a.*", GLOB_BRACE)[0];
					
					echo "<div class='row'>";
					echo "<div class='col-sm-1 col-xs-1 col-md-1 col-lg-1 alignCenter'> <input type='checkbox' name='". $result_products["product_id"] . "' id='checkbox_". $result_products["product_id"] . "' value='" . $result_products["product_price"]*$result_products["product_quantity"] . "' onclick='sumTotal(this.value,this.id)'/> </div>";
					
					echo "<div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 alignCenter'> <img class='list-group-image cartProductImg' src='" .  $product_image . "' alt='Picture of" . $result_products["product_name"] . "' /> </div>";
					
					echo "<div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 alignCenter'>" . $result_products["product_name"] . "</div>
						<div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 alignCenter'>" . number_format((float)$result_products["product_price"],2,'.','') . "</div>
						
						<div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 alignCenter'>
							<div class='input-group'>
							<span class='input-group-btn'>
								  <button type='button' class='btn btn-default btn-number' id='minus_button_" . $result_products['product_id'] . "' onclick='minusQuantity(". $result_products['product_id'] .",this.id,". $result_products["product_stockQty"] . ")'>
									  <span class='glyphicon glyphicon-minus'</span>
								  </button>
          					</span>
        						  <input type='text' class='form-control input-number' name='product_quantity_".$result_products['product_id'] . "' value='" . $result_products["product_quantity"] ."'   onkeydown='checkFinishTyping(this.name,". $result_products['product_id'] .",". $result_products["product_stockQty"] . ")'/>
         					 <span class='input-group-btn'>
								  <button type='button' class='btn btn-default btn-number'  id='plus_button_" . $result_products['product_id'] . "' onclick='addQuantity(". $result_products['product_id'] .",this.id,". $result_products["product_stockQty"] . ")'>
									  <span class='glyphicon glyphicon-plus'></span>
								  </button>
          					</span>
							</div>
						</div>
						<div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 alignCenter'>" . number_format((float)$result_products["product_price"]*$result_products["product_quantity"],2,'.','') . "</div>
						<div class='col-sm-1 col-xs-1 col-md-1 col-lg-1 alignCenter'><a href='#' onclick='removeItem(" . $result_products['product_id'] .")'><span class='glyphicon glyphicon-remove'></span></a></div>";
			
					echo "</div> <hr/>";					
				}
				
				echo "
                    <p class='alignRight'> Total price: <span id='total_price'></span></p>
                    <p class='alignRight'> <a class='btn btn-success' style='margin-right:10px;' onclick='checkout()'>Checkout</a> </p>
                ";
			}
            else
				echo "Something goes wrong, please try again later";
			
		}
        else
			echo "<p class='emptyCart'> Currently there is nothing in your cart :) </p>";
		
		mysqli_close($conn);
	}

?>