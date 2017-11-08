<?php
	require "db_conn.php";
	
	if(session_id() == "")
		session_start();

	// Check if all fields are set with value
    if( 
		isset($_POST["edit_product_id"]) && 
        isset($_SESSION["login_user"])   && 
        isset($_POST["new_quantity"])    && 
        isset($_POST["max_quantity"])
	)
    {		
        $edit_product_id = mysqli_real_escape_string($conn, $_POST["edit_product_id"]);
      	$userid          = mysqli_real_escape_string($conn, $_SESSION["login_user"]);
		$new_quantity    = mysqli_real_escape_string($conn,$_POST["new_quantity"]);
		$max_quantity    = mysqli_real_escape_string($conn,$_POST["max_quantity"]);
		$sql_table       = "cart_product";
		$product_table   = "products";
		
		$query  = "SELECT product_quantity FROM $sql_table WHERE product_id = '$edit_product_id'";
		$result = mysqli_query($conn,$query);
        
		if(mysqli_affected_rows($conn)>0)
        {
			$old_quantity = mysqli_fetch_assoc($result);
            $update_quantity = $new_quantity - $old_quantity["product_quantity"];
			if($new_quantity < 1)
            {
				$_SESSION["invalid_message"] = "Item quantity must be at least 1";
				$query = "UPDATE $sql_table SET product_quantity='1' WHERE userid = '$userid' AND product_id='$edit_product_id'";
			}
            else if($update_quantity > $max_quantity)
            {
                $_SESSION["invalid_message"] = "Item quantity has exceed the maximum quantity. The maximum quantity has taken.";
                $query = "UPDATE $sql_table SET product_quantity=product_quantity+'$max_quantity' WHERE userid = '$userid' AND product_id='$edit_product_id'";
			}
            else
            {
				$query = "UPDATE $sql_table SET product_quantity='$new_quantity' WHERE userid = '$userid' AND product_id='$edit_product_id'";
				unset($_SESSION["invalid_message"]);
			}

			$result = mysqli_query($conn, $query);

			if(mysqli_affected_rows($conn) > 0)
            {
				$update_quantity = $new_quantity - $old_quantity["product_quantity"];
				$query = "UPDATE $product_table SET product_stockQty = product_stockQty - '$update_quantity', product_qtyOnHold = product_qtyOnHold + '$update_quantity' WHERE product_id='$edit_product_id'";
				$result = mysqli_query($conn,$query);
                
				if(mysqli_affected_rows($conn)>0)
					if($new_quantity >=1 && $new_quantity <= $max_quantity)
						echo "Update item quantity successfully";
                else
					echo mysqli_error($conn);				
			}
            else
				echo "Something goes wrong, Please try again later";			
		}
        else
			echo mysqli_error($conn);
				
		mysqli_close($conn);
	}
    else	
		echo "Something goes wrong, Please try again later";
		
	
?>