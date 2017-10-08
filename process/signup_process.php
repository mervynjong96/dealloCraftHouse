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
		isset($_POST["userid"]) 			&& 
		isset($_POST["password"]) 			&& 
		isset($_POST["fname"]) 				&& 
		isset($_POST["lname"]) 				&& 
		isset($_POST["gender"]) 			&& 
		isset($_POST["country_code"]) 		&& 
		isset($_POST["phone_code"]) 		&& 
		isset($_POST["phone_number"]) 		&& 
		isset($_POST["shipping_address"]) 	&& 
		isset($_POST["postcode"]) 
	) {
        $email = mysql_real_escape_string($_POST["email"]);
        $userid = mysql_real_escape_string($_POST["userid"]);
        $password = mysql_real_escape_string($_POST["password"]);
        $name = mysql_real_escape_string($_POST["fname"] . " " . $_POST["lname"]);
        $gender = mysql_real_escape_string($_POST["gender"]);
        $country_code = mysql_real_escape_string($_POST["country_code"]);
        $mobileNumber = mysql_real_escape_string($_POST["phone_code"] . $_POST["phone_number"]);
        $shipping_address = mysql_real_escape_string($_POST["shipping_address"]);
        $postcode = mysql_real_escape_string($_POST["postcode"]);    

		// Insert user authentication information into database
		$sql_table = "account";
		$query = "INSERT INTO $sql_table VALUES ('$userid', '$email', '$password')";
		$result = mysqli_query($conn, $query);

		// Insert user info if user account created successfully
		if(mysqli_affected_rows($conn) > 0) {
			// Insert user information into database
			$sql_table = "userinfo";
			$query = "INSERT INTO $sql_table VALUES ('$userid','$name','$gender', '$country_code', '$mobileNumber', '$shipping_address', '$postcode')";
			$result = mysqli_query($conn, $query);

			if(mysqli_affected_rows($conn) > 0) {
				echo "Registration Success";
			} else {
				echo "Something went wrong, please try again later";
			}
		}
		// Return error message if register failed
		else {
			//Get error message
			$errorMsg = mysqli_error ($conn);
			
			//Return specified error message by detecting the error keyword contained in the returned error message
			if (strpos($errorMsg, 'PRIMARY')) {
				echo "Account with user id <$userid> existed, please try another one.";
			}
			else if (strpos($errorMsg, 'email')) {
				echo "Account with email <$email> existed, please try another one.";
			}
		}
		
		mysqli_close($conn);
	}
?>