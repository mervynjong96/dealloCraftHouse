<?php
	require "db_conn.php";

	// Check if all fields are set with value
    if( isset($_SESSION["login_user"]) )
    {
        $userid = $_SESSION["login_user"];
        
		//Count number of items in the database that matches userid
		$sql_table = "product_seller";
        $query = "
            SELECT
                products.product_id,
                products.product_name,
                products.product_price,
                products.product_stockQty
            FROM 
                product_seller, products 
            WHERE 
                product_seller.product_id = products.product_id
            AND 
                product_seller.userid = '$userid'
            AND
                products.active = 1
        ";
		$result = mysqli_query($conn, $query);
		
        if($result && $result->num_rows > 0)
        {        
            echo 
            "
                <div class='row'>
                    <div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 cartHeader' style='margin-top:0px'>Product Image</div>
                    <div class='col-sm-3 col-xs-3 col-md-3 col-lg-3 cartHeader' style='margin-top:0px'>Product Name</div>
                    <div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 cartHeader' style='margin-top:0px'>Price</div>
                    <div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 cartHeader' style='margin-top:0px'>Stock Quantity</div>
                    <div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 cartHeader' style='margin-top:0px'>Action</div>
                </div>
                <hr/>
            ";
            
            while($result_products = mysqli_fetch_assoc($result))        
            {
                $product_id       =   $result_products["product_id"];
                $img_dir          =   "./assets/images/products/" . $product_id;
                $product_image    =   glob("$img_dir/a.*", GLOB_BRACE)[0];
                $product_name     =   $result_products["product_name"];
                $product_price    =   number_format((float)$result_products["product_price"],2,'.','');
                $product_stockQty =   $result_products["product_stockQty"];                    
                echo 
                "
                    <div class='row'>
                        <div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 alignCenter'>
                            <a href='product_details.php?id=$product_id' class='productLink'>                        
                                <img style='width:100px; heigh:100px;' src='$product_image' alt='Picture of $product_image'/>
                            </a>
                        </div>                        
                        <div class='col-sm-3 col-xs-3 col-md-3 col-lg-3 alignCenter'>                        
                            <a href='product_details.php?id=$product_id' class='productLink'>$product_name</a>
                        </div>
                        <div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 alignCenter'>$product_price</div>						
                        <div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 alignCenter'>$product_stockQty</div>
                        <div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 alignCenter'>                                
                            <a href='productEdit.php?id=$product_id'>Edit</a> |
                            <a href='javascript:;' onclick='removeItem($product_id)'>Remove</a>
                        </div>
                    </div>
                    <hr/>
                ";
            }
		}
        else
			echo 
            "
                <div style='text-align:center'>
                    <img src='assets/images/emptyProduct.png'/>
                    <p>Oops, looks like you do not have anything to sell yet !</p>
                    <p>Perhaps you want to start your business now?</p>
                    <p><a href='productEdit.php' class='btn btn-success'>Add My Product</a></p>
                </div>
                <script>
                    // Hide add product button at top when there is no product registered by seller is listed
                    $('#btnAddProduct').hide();
                </script>
            ";
		
		mysqli_close($conn);
	}
?>