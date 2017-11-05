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
        if($result->num_rows > 0)
        {
            $columnName = array("Product Image","Product Name","Price","Stock Quantity","Action");
            echo "<div class='row'>";
                foreach($columnName as $c)
                    echo "<div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 cartHeader' style='margin-top:0px'>$c</div>";
            echo "</div><hr/>";
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
                            <img style='width:100px; heigh:100px;' src='$product_image' alt='Picture of $product_image'/>
                        </div>                        
                        <div class='col-sm-2 col-xs-2 col-md-2 col-lg-2 alignCenter'>$product_name</div>
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
			echo "<p class='emptyCart'>You do not have any registered product yet</p>";
		
		mysqli_close($conn);
	}
?>