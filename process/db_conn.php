<?php
    /* Database Connection Settings */
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

?>