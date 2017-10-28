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
				echo "<table border='1'>";
				while($result_products = mysqli_fetch_assoc($result)){
					echo "<tr>
								<td>" . $result_products["product_name"] . "</td>
								<td>" . $result_products["product_price"] . "</td>
								<td>" . $result_products["product_quantity"] . "</td>
								<td> <span class='glyphicon glyphicon-remove'></span> </td>
							</tr>";
							
				}
				echo "</table>";
			}else{
				echo "Something goes wrong, please try again later";
			}
		}else{
			echo "Currently there is nothing in your cart :)";
		}
		
		mysqli_close($conn);
	}
?>