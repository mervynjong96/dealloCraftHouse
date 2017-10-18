<?php
	
	session_start();

	include "smtpmailer_process.php";
	
	if(isset($_POST["email"])){
		$email = $_POST["email"];

		//$email = "jctaurus503@gmail.com";

		$digits = 5;
		$verification_code =  rand(pow(10, $digits-1), pow(10, $digits)-1);

		$_SESSION["verification_code"] = $verification_code;

		require_once '..\assets\PHPMailer\PHPMailerAutoload.php';

		$email_ID = "deallocrafthouse@gmail.com";
		$password = "Deallo123456";
		define ('GUSER',$email_ID);
		define ('GPWD',$password);

		$body = "<h1>Deallo Craft House</h1>";
		$body .= "<h2>Verification Code</h2>";
		$body .= "<p>Please enter the verification number below into respective field:</p>";
		$body .= "<h1>" . $verification_code . "</h1>";

		smtpmailer($email,'deallocrafthouse@gmail.com','Deallo Crafthouse','Password Recovery',$body);	
		
		echo "Please check your email for verification code";
	}
?>