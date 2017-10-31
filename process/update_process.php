<?php
    require "db_conn.php";

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
    mysqli_close($conn);
?>