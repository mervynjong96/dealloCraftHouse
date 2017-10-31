<?php
	require "db_conn.php";
	
	if(session_id() == "")
		session_start();

	// Check if all fields are set with value
    if( 
		isset($_POST["edit_product_id"]) && isset($_SESSION["login_user"]) && isset($_POST["new_quantity"])
	) {
		
        $edit_product_id = mysqli_real_escape_string($conn, $_POST["edit_product_id"]);
      	$userid = mysqli_real_escape_string($conn, $_SESSION["login_user"]);
		$new_quantity = mysqli_real_escape_string($conn,$_POST["new_quantity"]);

		$sql_table = "cart_product";
		
		$query = "UPDATE $sql_table SET product_quantity='$new_quantity' WHERE userid = '$userid' AND product_id='$edit_product_id'";
		$result = mysqli_query($conn, $query);

		if(mysqli_affected_rows($conn) > 0) {
			echo "Update item quantity successfully";
			
		}else{
			echo "Something goes wrong, Please try again later";
		}
		
		mysqli_close($conn);
	}else{
	
		echo "Something goes wrong, Please try again later";
		
	}
?>