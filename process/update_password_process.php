<?php
    require "db_conn.php";

	session_start();

	include "smtpmailer_process.php";

	// Check if all fields are set with value
    if( 
		isset($_POST["email"]) 					&& 
		isset($_POST["verification_code"]) 		&&
		isset($_POST["newPassword"])  			&&
		isset($_SESSION["verification_code"])
	) {
		if($_POST["verification_code"] == $_SESSION["verification_code"]){
			$email = mysqli_real_escape_string($conn, $_POST["email"]);
			$newPassword = mysqli_real_escape_string($conn, $_POST["newPassword"]);

			$sql_table = "account";

			$search_email_query = "SELECT * from $sql_table WHERE email = '$email'";

			$result_search = mysqli_query($conn,$search_email_query);

			if(mysqli_affected_rows($conn) > 0){

				$query = "UPDATE $sql_table SET password = '$newPassword' WHERE email = '$email'";
				$result = mysqli_query($conn, $query);


				if(mysqli_affected_rows($conn) > 0) {

					require_once '..\assets\PHPMailer\PHPMailerAutoload.php';

					$email_ID = "deallocrafthouse@gmail.com";
					$password = "Deallo123456";
					define ('GUSER',$email_ID);
					define ('GPWD',$password);

					$body = "<h1>Deallo Craft House</h1>";
					$body .= "<h2>Password Recovery</h2>";
					$body .= "<p>Your account password on our website has been changed.</p>";
					$body .= "<p>Please contact our customer service (082-589387) if you did not perform this action.</p>";

					smtpmailer($email,'deallocrafthouse@gmail.com','Deallo Crafthouse','Password Recovery',$body);	

					unset($_SESSION["verification_code"]);
					
					echo "Your password has been updated";

				}
			}else{
				echo "The email and/or old password you have entered is incorrect, please try again";
			}
		}else{
			echo "The verfication code you entered is incorrect, please try again";
		}
		
		mysqli_close($conn);
	}

?>