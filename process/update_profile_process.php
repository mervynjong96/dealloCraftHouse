<?php
    require "db_conn.php";

	session_start();

	include "smtpmailer_process.php";

	// Check if all fields are set with value
    if( 
		isset($_POST["verification_code"]) 		&&
		isset($_SESSION["verification_code"])
	) {
		if($_POST["verification_code"] == $_SESSION["verification_code"]){
            $email = mysqli_real_escape_string($conn, $_POST["email"]);
            $userid = mysqli_real_escape_string($conn, $_POST["userid"]);
            $password = mysqli_real_escape_string($conn, $_POST["password"]);
            $name = mysqli_real_escape_string($conn, $_POST["fname"] . " " . $_POST["lname"]);
            $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
            $country_code = mysqli_real_escape_string($conn, $_POST["country_code"]);
            $mobileNumber = mysqli_real_escape_string($conn, $_POST["phone_code"] . $_POST["phone_number"]);
            // $mobileNumber = mysqli_real_escape_string($conn, $_POST["phone_code"] . " " . $_POST["phone_number"]);
            $shipping_address = mysqli_real_escape_string($conn, $_POST["shipping_address"]);
            $postcode = mysqli_real_escape_string($conn, $_POST["postcode"]);    

            // Insert user authentication information into database
            if ($password != "") {
                $sql_table = "account";
                $query = "UPDATE $sql_table SET password='$password' WHERE userid='$userid'";
                $result = mysqli_query($conn, $query);
            }

            // Insert user information into database
            $sql_table = "userinfo";
            $query = "UPDATE $sql_table SET name='$name', gender='$gender', country='$country_code', contact_number='$mobileNumber', shipping_address='$shipping_address', postcode='$postcode' WHERE userid='$userid'";
            $result = mysqli_query($conn, $query);

            echo "Profile Saved Successfully!";
		}else{
			echo "The verfication code you entered is incorrect, please try again";
		}
		
		mysqli_close($conn);
	}

?>