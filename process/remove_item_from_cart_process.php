<?php
	require "db_conn.php";
	
	if(session_id() == "")
		session_start();

	// Check if all fields are set with value
    if( 
		isset($_POST["remove_product_id"]) && isset($_SESSION["login_user"])
	) {
		
        $remove_product_id = mysqli_real_escape_string($conn, $_POST["remove_product_id"]);
      	$userid = mysqli_real_escape_string($conn, $_SESSION["login_user"]);
		
		$sql_table = "cart_product";
		
		$query = "DELETE FROM $sql_table WHERE userid = '$userid' AND product_id='$remove_product_id'";
		$result = mysqli_query($conn, $query);

		if(mysqli_affected_rows($conn) > 0) {
			echo "Remove item successfully";
			
		}
		
		mysqli_close($conn);
	}else{
	
		echo "Something goes wrong, Please try again later";
		
	}
?>