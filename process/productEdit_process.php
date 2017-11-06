<?php
    require "db_conn.php";
//var_dump($_SESSION);
    session_start();

	// Check if all fields are set with value
    if( 
        isset($_SESSION["login_user"]      ) &&
		isset($_POST   ["product_category"]) && 
		isset($_POST   ["product_name"]    ) && 
		isset($_POST   ["product_desc"]    ) && 		
		isset($_POST   ["product_weight"]  ) && 
		isset($_POST   ["product_price"]   ) && 
		isset($_POST   ["product_policy"]  ) 	
	) {
        $product_category = mysqli_real_escape_string($conn, $_POST["product_category"]);
        $product_name = mysqli_real_escape_string($conn, $_POST["product_name"]);
        $product_desc = mysqli_real_escape_string($conn, $_POST["product_desc"]);		
        //$product_stockQty = "";
		//if(isset($_POST["product_stockQty"]))
        $product_stockQty = mysqli_real_escape_string($conn, $_POST["product_stockQty"]);		
        $product_weight = mysqli_real_escape_string($conn, $_POST["product_weight"]);
        $product_price = mysqli_real_escape_string($conn, $_POST["product_price"]);
        $product_policy = mysqli_real_escape_string($conn, $_POST["product_policy"]);		
        $product_tags = "";
		if(isset($_POST["product_tags"]))
        	$product_tags = mysqli_real_escape_string($conn, $_POST["product_tags"]);
				
		// Insert product info into database
		$sql_table = "products";
        $query     = "";
        if(isset($_POST["id"]))
        {
            $product_id = $_POST["id"];
            $query = "UPDATE $sql_table SET 
                product_category    =  '$product_category', 
                product_name        =  '$product_name'    , 
                product_desc        =  '$product_desc'    ,
                product_weight      =  '$product_weight'  ,
                product_price       =  '$product_price'   , 
                product_policy      =  '$product_policy'  , 
                product_tag         =  '$product_tags'    , 
                product_stockQty    =  '$product_stockQty'
            WHERE
                product_id          =  '$product_id'
            ";
        }
        else
        {
            $query = "INSERT INTO $sql_table 
            (
                product_category, 
                product_name, 
                product_desc,
                product_weight,
                product_price, 
                product_policy, 
                product_tag, 
                product_stockQty
            ) VALUES (
                '$product_category',
                '$product_name',
                '$product_desc',
                '$product_weight',
                '$product_price',
                '$product_policy',
                '$product_tags',
                '$product_stockQty'
            ) ";
            
            $result = mysqli_query($conn, $query);
            $insert_id = mysqli_insert_id($conn);
            
            $userid = $_SESSION["login_user"];
            $query = "INSERT INTO product_seller (product_id, userid) VALUES ( '$insert_id', '$userid' )";
        }
        
		$result = mysqli_query($conn, $query);
        
		if(mysqli_affected_rows($conn) > 0) {
            /*
		  // Insert product variation information if product is registered successfully
			// Build query
			if($insert_id !== "" && $product_stockQty == "")
			{
				$sql_table = "product_variation";
				$query = "INSERT INTO $sql_table (product_id,";

				$variation_number = $_POST["variation_number"];
				// Loop to concatenate query string by filling all fields value
				for($i=1; $i<=$variation_number; $i++) {
					if($i >= 2)
						$query .= ",";
					
					$query .= "size_$i, color_$i, stockQty_$i";
				}
				$query .= ") VALUES ($insert_id,";
				for($i=1; $i<=$variation_number; $i++) {
					$productSize = $_POST["size_".$i];
					$productColor = $_POST["color_".$i];
					$productStockQty = $_POST["stockQty_".$i];

					if(!isset($productSize))
						$productSize = "";
					if(!isset($productColor))
						$productColor = "";

					if($i >= 2)
						$query .= ",";

					if( isset($productStockQty) ) {				
						if( isset($productSize) || isset($productColor) ) {
							$query .= "'$productSize', '$productColor', '$productStockQty'";
						}
					}
					else
						break;
				}
				$query .= ")";
				mysqli_query($conn, $query) or die(mysqli_error ($conn));				
			}*/
            
            // Store new product id and image uploader will get the product id to create new folder for it and put the images into the folder
            if(!isset($_POST["id"]))
			     $_SESSION["product_id"] = $insert_id;
			echo "success";
		}
		else {
			//Get error message
			$errorMsg = mysqli_error ($conn);
			die($errorMsg);
		}
		
		mysqli_close($conn);
	}
?>
