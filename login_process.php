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
		isset($_POST["email"]) 				&& 
		isset($_POST["password"]) 			&& 
	) {
        $email = mysql_real_escape_string($_POST["login_email"]);
        $password = mysql_real_escape_string($_POST["login_password"]);
   
		// Insert user authentication information into database
		$sql_table = "account";
		$query = "SELECT * FROM $sql_table WHERE userid = '$email' OR email = '$email' AND password =  '$password'";
		$result = mysqli_query($conn, $query);

		// Insert user info if user account created successfully
		if(mysqli_affected_rows($conn) > 0) {
			// Insert user information into database
				echo "Login Success";
		}
		// Return error message if register failed
		else {
			echo "Your account and/or password is incorrect, please try again";
		}
		
		mysqli_close($conn);
	}
?>