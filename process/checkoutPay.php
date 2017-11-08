<?php
    require "db_conn.php";

    session_start();

	// Check if all fields are set with value
    if( isset($_SESSION["login_user"]) && isset($_POST["checkoutItem"]) )
    {
        //Update transaction relevant tables
        $checkoutItem = json_decode($_POST["checkoutItem"]);
        $uid = $_SESSION["login_user"];
        $totalAmount = $checkoutItem->totalAmount;      //get totalAmount attribute
        unset($checkoutItem->totalAmount);              //unset it from checkoutItem object so that it contains only checkout items

        // Insert current transaction into database
        $sql_table = "user_transactions";
        $query     = "INSERT INTO $sql_table (user_id,total_amount) VALUES ('$uid','$totalAmount')";
        $result = mysqli_query($conn, $query);
        $insert_id = mysqli_insert_id($conn);

        if(mysqli_affected_rows($conn) > 0)
        {
            $itemIDs = [];
            $sql_table = "transaction_products";
            $query = "INSERT INTO $sql_table VALUES";
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
                
                if(mysqli_affected_rows($conn) > 0)
                {                    
                    $sql_table = "products";
                    $query = "INSERT INTO $sql_table (`product_id`,`product_qtyOnHold`,`product_quantity_sold`) VALUES ";

                    foreach ($checkoutItem as $id=>$attr)
                    {
                        $qty    = $attr->quantity;
                        $query .= "($id,`product_qtyOnHold`+product_qtyOnHold-$qty,`product_quantity_sold`+product_quantity_sold+$qty),";
                    }
                    
                    $query = rtrim($query,",");
                    $query .=
                    "
                        ON DUPLICATE KEY UPDATE
                            `product_qtyOnHold`     = VALUES(`product_qtyOnHold`)     + product_qtyOnHold,
                            `product_quantity_sold` = VALUES(`product_quantity_sold`) + product_quantity_sold
                    ";
                    
                    $result = mysqli_query($conn, $query);
                    if(mysqli_affected_rows($conn) > 0)
                    {
                        date_default_timezone_set('Etc/GMT-8');
                        $dateNow = date_default_timezone_get();
                        $datetime = date('d/M/Y (D) h:i:sA');
                        $_SESSION["status"] = "success";
                        echo "success $datetime";                        
                    }
                    else
                        echo "Something went wrong ! Please try again later.";
                }
            }
		}
		else
			die(mysqli_error ($conn));
		
		mysqli_close($conn);
	}
?>