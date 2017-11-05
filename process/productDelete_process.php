<?php
    require "db_conn.php";
    session_start();

	// Check if all fields are set with value
    if( isset($_SESSION["login_user"]) && isset($_POST["product_id"]) )
    {
		// Insert product info into database
		$sql_table = "products";
        $product_id = $_POST["product_id"];
        $query = "UPDATE $sql_table SET active = 0 WHERE product_id = $product_id";

        $result = mysqli_query($conn, $query);
		
		if(mysqli_affected_rows($conn) > 0)
            echo "success";
		else
            echo "fail";
    
		mysqli_close($conn);
	}
?>
