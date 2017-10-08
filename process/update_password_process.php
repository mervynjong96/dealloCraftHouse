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

// xampp code fix      
ini_set( 'sendmail_from', "jctaurus503@gmail.co" ); 
ini_set( 'SMTP', "mail.bigpond.com" );  
ini_set( 'smtp_port', 25 );

	session_start();

	// Check if all fields are set with value
    if( 
		isset($_POST["email"]) 					&& 
		isset($_POST["oldPassword"]) 			&&
		isset($_POST["newPassword"]) 
	) {
        $email = mysql_real_escape_string($_POST["email"]);
        $oldPassword = mysql_real_escape_string($_POST["oldPassword"]);
		$newPassword = mysql_real_escape_string($_POST["newPassword"]);
   
		$sql_table = "account";
		
		$search_email_query = "SELECT * from $sql_table WHERE email = '$email' AND password = '$oldPassword'";
		
		$result_search = mysqli_query($conn,$search_email_query);
		
		if(mysqli_affected_rows($conn) > 0){

			$query = "UPDATE $sql_table SET password = '$newPassword' WHERE email = '$email'";
			$result = mysqli_query($conn, $query);


			if(mysqli_affected_rows($conn) > 0) {
				/*$to = $email; //Send email to user
				$subject = "Your password has been updated";
				$message = "This email is to notify you that your account password on our website has been changed. Please contact our customer service if you did not perform this action. -----------
				Customer service hotline: 1300-13-8989";
				$headers = 'From:noreply@deallocrafthouse.com' . "\r\n";
				mail($to, $subject, $message, $headers); // Send our email*/
				
				echo "Your password has been changed successfully";
			}
			// Return error message if login failed
			else {
				echo "Your account and/or password is incorrect, please try again";
			}
		}else{
			echo "The email and/or old password you have entered is incorrect, please try again";
		}
		
		mysqli_close($conn);
	}
?>