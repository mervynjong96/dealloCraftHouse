<?php
	require "db_conn.php";

	if(session_id() == "")
		session_start();

	// Check if all fields are set with value
    if( isset($_SESSION["login_user"]) ) {
        $userid = mysqli_real_escape_string($conn, $_SESSION["login_user"]);
      
		//Count number of items in the database that matches userid
		$sql_table = "cart_product";
		$query = "SELECT COUNT(*) as items_count FROM $sql_table WHERE userid = '$userid'";
		$result = mysqli_query($conn, $query);

		if(mysqli_affected_rows($conn) > 0) {
			$result_items = mysqli_fetch_assoc($result);
			// save it into session and display it on the navigation bar
			$_SESSION["items_in_cart"]	= $result_items["items_count"];
		}
		
		mysqli_close($conn);
	}
?>