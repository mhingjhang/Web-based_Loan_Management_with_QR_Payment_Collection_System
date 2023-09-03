<?php

$servername = "localhost";
$username = "u482416179_mhingjhang";
$password = "Luthor010";
$dbname = "u482416179_loanmanagement";


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
date_default_timezone_set("Asia/Kolkata");
mysqli_set_charset($conn, "utf8");
?>