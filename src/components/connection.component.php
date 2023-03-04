<?php
// db connection
$host = "localhost";
$user = "ssarfaraz";
$pass = "xUCeLzDv";
$db = "ssarfaraz";
$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
