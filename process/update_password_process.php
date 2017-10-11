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
		isset($_POST["email"]) 					&& 
		isset($_POST["oldPassword"]) 			&&
		isset($_POST["newPassword"]) 
	) {
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $oldPassword = mysqli_real_escape_string($conn, $_POST["oldPassword"]);
		$newPassword = mysqli_real_escape_string($conn, $_POST["newPassword"]);
   
		$sql_table = "account";
		
		$search_email_query = "SELECT * from $sql_table WHERE email = '$email' AND password = '$oldPassword'";
		
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

				
					echo "Your password has been updated";
				
		
			}
		}else{
			echo "The email and/or old password you have entered is incorrect, please try again";
		}
		
		mysqli_close($conn);
	}


// make a separate file and include this file in that. call this function in that file.

function smtpmailer($to, $from, $from_name, $subject, $body) { 
	global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	//$mail->SMTPDebug = 2;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
	$mail->SMTPAutoTLS = false;
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;

	$mail->Username = GUSER;  
	$mail->Password = GPWD;           
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->IsHTML(true);
	$mail->Body = $body;
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		return false;
	} else {
		return true;
	}
		
}
?>