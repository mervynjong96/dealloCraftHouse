<?php
	session_start();
	$file = $_FILES['imageUploader'];
	$realpath = '../assets/images/products/'.$_SESSION["product_id"].'/';
	if (!file_exists($realpath)) {
		mkdir($realpath, 0755, true);
	}
	move_uploaded_file($file["tmp_name"], $realpath.$file["name"]); //move files
	$result = array("status"=>"server");
	echo json_encode($result);
?>