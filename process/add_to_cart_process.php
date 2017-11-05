<?php
	require "db_conn.php";

	// Check if all fields are set with value
    if( 
		isset($_POST["product_id"]) && isset($_SESSION["login_user"]) && isset($_POST["item_quantity"]) && isset($_POST["max_quantity"])
	) {
		
        $product_id = mysqli_real_escape_string($conn, $_POST["product_id"]);
      	$userid = mysqli_real_escape_string($conn, $_SESSION["login_user"]);
		$new_quantity = mysqli_real_escape_string($conn,$_POST["item_quantity"]);
		$max_quantity = mysqli_real_escape_string($conn,$_POST["max_quantity"]);
		$sql_table = "cart_product";
		
		if($new_quantity < 1){
			echo "Item quantity must be at least 1";
		}else if($new_quantity > $max_quantity){
			echo "Item quantity has exceed the maximum quantity.";
		}else{
			$query = "UPDATE $sql_table SET product_quantity='$new_quantity' WHERE userid = '$userid' AND product_id='$product_id'";
		}
		
		$result = mysqli_query($conn, $query);

		if(mysqli_affected_rows($conn) > 0) {
				echo "Update item quantity successfully";
		}else{
			echo "Something goes wrong, Please try again later";
		}
		
		mysqli_close($conn);
	}else{
	
		echo "Something goes wrong, Please try again later";
		
	}
?>