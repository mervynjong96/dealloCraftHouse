<?php
	require "db_conn.php";
    
	// Check if all fields are set with value
    if( isset($_SESSION["login_user"]) && isset($_POST["checkedItemID"]) )
    {
        $_SESSION["checkoutSession"] = date('d/M/Y (D) h:i:sA');
        $userid = $_SESSION["login_user"];
        $checkedItemID = $_POST["checkedItemID"];
        $checkedItemID = json_decode($checkedItemID);
        $checkedItemID = implode (", ", $checkedItemID);
        
        
        // Get user's shipping address
		$sql_table = "userinfo";
        $query = " SELECT name, contact_number, shipping_address from $sql_table where userid = '$userid'";   
		$result = mysqli_fetch_assoc(mysqli_query($conn, $query));
		$buyerName          = $result["name"];
		$buyerContactNumber = $result["contact_number"];
		$shipping_address   = $result["shipping_address"];
        
        // Get selected checkout product details from cart only
		$sql_table = "cart_product";        
        $query = 
        "
            SELECT
                products.product_id,
                products.product_name,
                products.product_price,
                cart_product.product_quantity
            FROM 
                $sql_table
            INNER JOIN products ON
                products.product_id = cart_product.product_id
            AND
                cart_product.product_id in ($checkedItemID)
        ";
        
		$result = mysqli_query($conn, $query);		
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
            $checkoutTotalAmount = 0;
            while($result_products = mysqli_fetch_assoc($result))        
            {
                // For each successive fetched product, store the following details to be displayed into views:
                $product_id           =   $result_products["product_id"];
                $img_dir              =   "./assets/images/products/" . $product_id;
                $product_image        =   glob("$img_dir/a.*", GLOB_BRACE)[0];
                $product_name         =   $result_products["product_name"];
                $product_price        =   number_format((float)$result_products["product_price"],2,'.','');
                $product_quantity     =   $result_products["product_quantity"];
                $total_amount         =   number_format((float)($product_price * $product_quantity),2,'.','');
                $checkoutTotalAmount  += $total_amount;
                
                /* Explicitly for debugging usage only 
                $result_products["subtotal"] = $total_amount;
                $debugItem = $result_products;
                $debugItem = json_encode($result_products);
                echo "<script type='text/javascript'>console.log($debugItem);</script>"; */
                
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
                
                $checkout[$product_id]['quantity']  = $product_quantity;
                $checkout[$product_id]['price']     = $product_price;
            }
            
            $checkout['totalAmount'] = $checkoutTotalAmount;
            
            echo "
                <div id='checkoutSummary'>
                    <p>
                        <span style='font-size:20px;'><strong>Nett Total:</span>
                        <span style='font-size:30px;' class='fa fa-dollar'></span>
                        </strong><span style='font-size:28px;' id='totalAmount'>".number_format((float)$checkoutTotalAmount,2,'.','') ."</span></p>
                    <p><span style='font-size:16px;'><strong>Ship To: </strong></span> <span id='shippingAddress'>$shipping_address</span></p>
                    <p><span style='font-size:16px;'><strong>Recipient: </strong></span>$buyerName ($buyerContactNumber)</p>
                </div>
                <p style='text-align:right; clear:both;'>
                    <a href='cart_view.php' style='margin-right:50px;'>
                        <span class='glyphicon glyphicon-circle-arrow-left'></span> Back to shopping cart
                    </a>
                    <a class='btn btn-success btn-pay' id='btnPay'><strong>Pay Now</strong></a>
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