<?php
	require "db_conn.php";

	if(!isset($_SESSION))
		session_start();

	// Check if all fields are set with value
    if( 
		isset($_POST["product_id"])    &&
        isset($_SESSION["login_user"]) &&
        isset($_POST["item_quantity"]) &&
        isset($_POST["max_quantity"])
	)
    {        
        $product_id    = mysqli_real_escape_string($conn,$_POST["product_id"]);
      	$userid        = mysqli_real_escape_string($conn,$_SESSION["login_user"]);
		$new_quantity  = mysqli_real_escape_string($conn,$_POST["item_quantity"]);
		$max_quantity  = mysqli_real_escape_string($conn,$_POST["max_quantity"]);
		
		$cart_table    = "cart_product";
		$product_table = "products";
		if($new_quantity < 1)
			echo "Item quantity must be at least 1";
		else if($new_quantity > $max_quantity)
			echo "Item quantity has exceed the maximum quantity.";
		else
        {
			$query = "UPDATE $cart_table SET product_qtyOnHold = product_qtyOnHold + '$new_quantity' WHERE userid='$userid' AND product_id='$product_id' ";
            $result = mysqli_query($conn,$query);

            if(mysqli_affected_rows($conn) > 0)
            {
                $query = "UPDATE $product_table SET product_stockQty = product_stockQty - '$new_quantity', product_qtyOnHold = product_qtyOnHold + '$new_quantity' WHERE product_id='$product_id'";
                $result = mysqli_query($conn,$query);
                
                if(mysqli_affected_rows($conn)>0)
                    echo "Item has added to the cart";
                else
                    echo mysqli_error($conn);               
            }
            else
            {				
                $query = "INSERT INTO $cart_table(userid,product_id,product_quantity)VALUES('$userid','$product_id','$new_quantity')";
                $result = mysqli_query($conn,$query);

                if(mysqli_affected_rows($conn) > 0)
                {
                    $query = "UPDATE $product_table SET product_stockQty = product_stockQty - '$new_quantity', product_qtyOnHold = product_qtyOnHold + '$new_quantity' WHERE product_id='$product_id'";
                    $result = mysqli_query($conn,$query);
                    if(mysqli_affected_rows($conn)>0)
                        echo "Item has added to the cart";
                    else
                        echo mysqli_error($conn);					
                }
                else
                    echo mysqli_error($conn);				
			}
		}
		mysqli_close($conn);
	}
    else	
		echo "Something goes wrong, Please try again later";		
	
?>