<?php
    require "db_conn.php";
	include "smtpmailer_process.php";
	if(session_id()==""){
		session_start();
	}

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

		if(mysqli_affected_rows($conn)>0){
			require_once '..\assets\PHPMailer\PHPMailerAutoload.php';

			$email_ID = "deallocrafthouse@gmail.com";
			$password = "Deallo123456";
			define ('GUSER',$email_ID);
			define ('GPWD',$password);
			$body = "<h1>Deallo Craft House</h1>";
			$body .= "<h2>Changes on your account information</h2>";
			$body .= "<p>Your account information/account password on our website has been changed.</p>";
			$body .= "<p>Please contact our customer service (082-589387) if you did not perform this action.</p>";

			smtpmailer($email,'deallocrafthouse@gmail.com','Deallo Crafthouse','Password Recovery',$body);	

			unset($_SESSION["verification_code"]);


		}
		
		echo "Profile Saved Successfully!";
   
	}else{
		echo "The verification code you entered is invalid";
	}
    mysqli_close($conn);
?>