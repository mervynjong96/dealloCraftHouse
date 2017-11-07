<?php
    require "db_conn.php";

    session_start();

//$query = "
//INSERT INTO products (`product_id`,`product_qtyOnHold`,`product_quantity_sold`) VALUES (30,`product_qtyOnHold`,`product_quantity_sold`),(31,`product_qtyOnHold`,`product_quantity_sold`)
//ON DUPLICATE KEY UPDATE `product_qtyOnHold`=`product_qtyOnHold`+8,`product_quantity_sold`=`product_quantity_sold`+8
//
//";
//$query = "UPDATE products SET product_qtyOnHold = product_qtyOnHold - " ;
//echo $query;
	// Check if all fields are set with value
    if( isset($_SESSION["login_user"]) && isset($_POST["checkoutItem"]) )
    {
        //Update transaction relevant tables
        $checkoutItem = json_decode($_POST["checkoutItem"]);
        $uid = $_SESSION["login_user"];
        $totalAmount = $checkoutItem->totalAmount;
        unset($checkoutItem->totalAmount);

        // Insert current transaction into database
        $sql_table = "user_transactions";
        $query     = "INSERT INTO $sql_table (user_id,total_amount) VALUES ('$uid','$totalAmount')";
        $result = mysqli_query($conn, $query);
        $insert_id = mysqli_insert_id($conn);

        if(mysqli_affected_rows($conn) > 0)
        {
            $itemIDs = [];
            $query = "INSERT INTO transaction_products VALUES";
            foreach ($checkoutItem as $id=>$attr)
            {
                $itemIDs[] = $id;
                $query .= "('$insert_id', '$id', '$attr->quantity', '$attr->price'),";
            }
            
            // Cut off last coma
            $query = rtrim($query,",");
            $result = mysqli_query($conn, $query);
            
            $itemIDs = implode (", ", $itemIDs);
            if(mysqli_affected_rows($conn) > 0)
            {          
                // Insert current transaction into database
                $sql_table = "cart_product";
                $query     = "DELETE FROM $sql_table WHERE product_id in ($itemIDs) AND userid = '$uid'";
                $result = mysqli_query($conn, $query);
                $insert_id = mysqli_insert_id($conn);
                
                if(mysqli_affected_rows($conn) > 0)
                {         
                    date_default_timezone_set('Etc/GMT-8');
                    $dateNow = date_default_timezone_get();
                    $datetime = date('d/M/Y (D) h:i:sA');
                    echo "success $datetime";
                }
            }
		}
		else {
			//Get error message
			$errorMsg = mysqli_error ($conn);
			die($errorMsg);
		}
		
		mysqli_close($conn);
	}
?>
