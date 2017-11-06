<?php
	require "db_conn.php";
	
	if(session_id() == "")
		session_start();

	// Check if all fields are set with value
    if( 
		isset($_POST["remove_product_id"]) && isset($_SESSION["login_user"])
	) {
		
        $remove_product_id = mysqli_real_escape_string($conn, $_POST["remove_product_id"]);
      	$userid = mysqli_real_escape_string($conn, $_SESSION["login_user"]);
		$product_table = "products";
		$sql_table = "cart_product";
		$query  = "SELECT product_quantity FROM $sql_table WHERE product_id = '$remove_product_id'";
		$result = mysqli_query($conn,$query);
		if(mysqli_affected_rows($conn)>0){
			$item_quantity = mysqli_fetch_assoc($result);
			$query = "DELETE FROM $sql_table WHERE userid = '$userid' AND product_id='$remove_product_id'";
			$result = mysqli_query($conn, $query);

			if(mysqli_affected_rows($conn) > 0) {
				$stock_quantity = $item_quantity["product_quantity"];
				$query = "UPDATE $product_table SET product_stockQty = product_stockQty + '$stock_quantity', product_qtyOnHold = product_qtyOnHold - '$stock_quantity' WHERE product_id='$remove_product_id'";
				$result = mysqli_query($conn,$query);
				if(mysqli_affected_rows($conn)>0){

					echo "Remove item successfully";

				}else{
					echo mysqli_error($conn);
				}
			}
		}
		
		mysqli_close($conn);
	}else{
	
		echo "Something goes wrong, Please try again later";
		
	}
?>