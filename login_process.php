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

	session_start();

	// Check if all fields are set with value
    if( 
		isset($_POST["email"]) 				&& 
		isset($_POST["password"]) 			
	) {
        $email = mysql_real_escape_string($_POST["email"]);
        $password = mysql_real_escape_string($_POST["password"]);
   
		// Insert user authentication information into database
		$sql_table = "account";
		$query = "SELECT * FROM $sql_table WHERE email = '$email' AND password =  '$password'";
		$result = mysqli_query($conn, $query);
		
		
		if(mysqli_affected_rows($conn) > 0) {
			$result_info = mysqli_fetch_assoc($result);
			// The account is found and matches the password in the database
			echo "Login Success";
			$_SESSION["login_user"] = $result_info["userid"];
		}
		// Return error message if login failed
		else {
			echo "Your account and/or password is incorrect, please try again";
		}
		
		mysqli_close($conn);
	}
?>