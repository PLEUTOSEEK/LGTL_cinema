<?php

$host = "localhost";
$uname = "root";
//$pass = "1234";
$db_name = "lgtl_cinema";

$result = mysqli_connect($host, $uname) or die("Could not connect to database." . mysqli_error());
mysqli_select_db($result, $db_name) or die("Could not select the databse." . mysqli_error());
?>
