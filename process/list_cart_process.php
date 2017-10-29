<?php
	$host = "localhost";
	$user = "root";
	$pwd = "";
	$sql_db = "deallocrafthouse";
	$conn = @mysqli_connect(
		$host,
		$user,
		$pwd,
		$sql_db
	);

	$total = 0;

	// Check if all fields are set with value
    if( 
		isset($_SESSION["login_user"])
	) {
        $userid = mysqli_real_escape_string($conn, $_SESSION["login_user"]);
      
		//Count number of items in the database that matches userid
		$sql_table = "cart_product";
		$query = "SELECT COUNT(*) as items_count FROM $sql_table WHERE userid = '$userid'";
		$result = mysqli_query($conn, $query);

		if(mysqli_affected_rows($conn) > 0) {
			$query = "SELECT cart_product.product_quantity,products.product_id,products.product_name,products.product_price FROM cart_product, products WHERE cart_product.product_id = products.product_id
			 AND cart_product.userid = '$userid' ";
			$result = mysqli_query($conn, $query);
			if(mysqli_affected_rows($conn)>0){
				//echo "<table border='1'>";
				while($result_products = mysqli_fetch_assoc($result)){
						
					$directory = "./assets/images/products/" . $result_products["product_id"];
					$images = glob("$directory/a.{jpg,png,bmp}", GLOB_BRACE);
					
					foreach($images as $image)
					{
						$product_image = $image;
						break;
					}
					echo "<div class='row'>";
					echo "<div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 alignCenter'> <input type='checkbox' name='checkbox_". $result_products["product_id"] . "' id='checkbox_". $result_products["product_id"] . "' value='" . $result_products["product_price"]*$result_products["product_quantity"] . "' onclick='sumTotal(this.value,this.name)'/> </div>";
					
					echo "<div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 alignCenter'> <img class='list-group-image productimg' src='" .  $product_image . "' alt='Picture of" . $result_products["product_name"] . "' /> </div>";
					
					echo "<div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 alignCenter'>" . $result_products["product_name"] . "</div>
						<div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 alignCenter'>" . number_format((float)$result_products["product_price"]*$result_products["product_quantity"],2,'.','') . "</div>
						<div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 alignCenter'> <input type='number' size='1' min='1' value='" . $result_products["product_quantity"] . "'/></div>
						<div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 alignCenter'><span class='glyphicon glyphicon-remove'></span></div>";
					
					/*echo "<tr>
								<td> <input type='checkbox' name='". $result_products["product_id"] . "' value='" . $result_products["product_price"]*$result_products["product_quantity"] . "'/> </td>
								<td> <img class='list-group-image productimg' src='" .  $product_image . "' alt='Picture of" . $result_products["product_name"] . "' /> </td>
								<td>" . $result_products["product_name"] . "</td>
								<td>" . $result_products["product_price"]*$result_products["product_quantity"] . "</td>
								<td>" . $result_products["product_quantity"] . "</td>
								<td> <span class='glyphicon glyphicon-remove'></span> </td>
							</tr>";*/
					echo "</div>";	
				}
				//echo "</table>";
				
				/*echo "<p class='alignRight'> Total price:" . $total . "	 </p>
					  <p class='alignRight'> <a class='btn btn-success' style='margin-right:10px;' onClick='alert($total)'>Checkout</a> </p>
				";*/
			}else{
				echo "Something goes wrong, please try again later";
			}
		}else{
			echo "Currently there is nothing in your cart :)";
		}
		
		mysqli_close($conn);
	}

?>