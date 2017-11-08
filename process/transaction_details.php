<?php
	require "db_conn.php";
    
	// Check if all fields are set with value
    if( isset($_SESSION["login_user"]) && isset($_GET["id"]) )
    {
        $userid = $_SESSION["login_user"];
        $transaction_id = $_GET["id"];
        
        // Get selected checkout product details from cart only
		$sql_table = "transaction_products";        
        $query = 
        "
            SELECT
            	user_transactions.transaction_id,
            	user_transactions.date_paid,
                products.product_id,
                products.product_name,
                transaction_products.price,
                transaction_products.quantity,
                user_transactions.total_amount,
                user_transactions.date_paid,
                userinfo.name,
                userinfo.shipping_address
            FROM 
                $sql_table
            INNER JOIN products ON
                products.product_id = transaction_products.product_id
            INNER JOIN user_transactions ON
                user_transactions.transaction_id = transaction_products.transaction_id
            INNER JOIN userinfo ON
                userinfo.userid = user_transactions.user_id
            AND
            	user_transactions.user_id = '$userid'
            AND
            	user_transactions.transaction_id = '$transaction_id';
        ";
        
		$results = mysqli_query($conn, $query);		
        if($result && $result->num_rows > 0)
        {
            echo 
            "
                <div class='row'>
                    <div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 checkoutHeader' style='margin-top:0px'>Product Image</div>
                    <div class='col-sm-3 col-xs-3 col-md-3 col-lg-3 checkoutHeader' style='margin-top:0px'>Product Name</div>
                    <div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 checkoutHeader' style='margin-top:0px'>Price</div>
                    <div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 checkoutHeader' style='margin-top:0px'>Quantity</div>
                    <div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 checkoutHeader' style='margin-top:0px'>Subtotal</div>
                </div>
                <hr/>
            ";
            $transactionTotalAmount = 0;
            
            while($result = mysqli_fetch_assoc($results))        
            {
                // Transaction shipping info
                $transactionID           =   $result["transaction_id"];
                $datePaid                =   $result["date_paid"];
                $recipientName           =   $result["name"];
                $shipping_address        =   $result["shipping_address"];
                
                // Transaction product details
                $product_id              =   $result["product_id"];
                $img_dir                 =   "./assets/images/products/" . $product_id;
                $product_image           =   glob("$img_dir/a.*", GLOB_BRACE)[0];
                $product_name            =   $result["product_name"];
                $product_price           =   number_format((float)$result["price"],2,'.','');
                $product_quantity        =   $result["quantity"];
                $total_amount            =   number_format((float)($product_price * $product_quantity),2,'.','');
                $transactionTotalAmount  += $total_amount;
                    
                echo 
                "
                    <div class='row'>
                        <div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 alignCenter'>
                            <img class='checkoutProductImg' src='$product_image' alt='Picture of $product_image'/>
                        </div>                        
                        <div class='col-sm-3 col-xs-3 col-md-3 col-lg-3'>$product_name</div>
                        <div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 alignCenter'>$$product_price</div>
                        <div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 alignCenter'>$product_quantity</div>
                        <div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 alignCenter'>$$total_amount</div>
                    </div>
                    <hr/>
                ";
            }
            $datePaid = strtotime($datePaid);
            $datePaid = date('d/M/Y h:i:s A',$datePaid);
            
            echo "
                <div id='checkoutSummary'>
                    <p>
                        <span style='font-size:20px;'><strong>Nett Total:</span>
                        <span style='font-size:30px;' class='fa fa-dollar'></span>
                        </strong><span style='font-size:28px;' id='totalAmount'>".number_format((float)$transactionTotalAmount,2,'.','') ."</span></p>
                    <p><span style='font-size:16px;'><strong>Transaction ID: </strong></span>$transaction_id</p>
                    <p><span style='font-size:16px;'><strong>Date Paid: </strong></span>$datePaid</p>
                    <p><span style='font-size:16px;'><strong>Ship To: </strong></span>$shipping_address</p>
                    <p><span style='font-size:16px;'><strong>Recipient: </strong></span>$recipientName</p>
                </div>
                <p style='text-align:right; clear:both;'><br/>
                    <a href='transaction_history.php'>
                        <span class='glyphicon glyphicon-circle-arrow-left'></span> Back to Transaction history
                    </a>
                </p>
            ";
		}
		
		mysqli_close($conn);
	}
    else
    {
        //header("location:index.php");
    }
?>