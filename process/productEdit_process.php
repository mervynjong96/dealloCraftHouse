<?php
	$host = "localhost";
	$user = "root";
	$pwd = "";
	$sql_db = "deallocrafthouse";
	$conn = @mysqli_connect(
		$host,
		$user,
		$pwd,
		$sql_db
	);

	// Check if all fields are set with value
    if( 
		isset($_POST["product_category"]) 	&& 
		isset($_POST["product_name"]) 		&& 
		isset($_POST["product_desc"]) 		&& 		
		isset($_POST["product_weight"]) 	&& 
		isset($_POST["product_price"]) 		&& 
		isset($_POST["product_policy"]) 	
	) {
        $product_category = mysqli_real_escape_string($conn, $_POST["product_category"]);
        $product_name = mysqli_real_escape_string($conn, $_POST["product_name"]);
        $product_desc = mysqli_real_escape_string($conn, $_POST["product_desc"]);
		
        $product_stockQty = "";
		if(isset($_POST["product_stockQty"]))
        	$product_stockQty = mysqli_real_escape_string($conn, $_POST["product_stockQty"]);
		
        $product_weight = mysqli_real_escape_string($conn, $_POST["product_weight"]);
        $product_price = mysqli_real_escape_string($conn, $_POST["product_price"]);
        $product_policy = mysqli_real_escape_string($conn, $_POST["product_policy"]);
		
        $product_tags = "";
		if(isset($_POST["product_tags"]))
        	$product_tags = mysqli_real_escape_string($conn, $_POST["product_tags"]);
		
		$fields = array('passengerName', 'passengerContact', 'unit_number','street_number', 'street_name', 'suburb', 'destination_suburb','pickup_date','pickup_time');
		
		// Insert product info into database
		$sql_table = "products";
		$query = "INSERT INTO $sql_table (product_category,product_name,product_desc,product_weight,product_price,product_policy,product_tag,product_stockQty) VALUES ('$product_category', '$product_name', '$product_desc', '$product_weight', '$product_price', '$product_policy','$product_tags','$product_stockQty')";
		$result = mysqli_query($conn, $query);
		$insert_id = mysqli_insert_id($conn);
		
		// Insert product additional information if product is registered successfully
		if(mysqli_affected_rows($conn) > 0) {
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
			}
			session_start();
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