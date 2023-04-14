<?php
session_start();
require_once "../components/connection.component.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $userId = $_SESSION["user_id"];
    $fullName = $_POST["user_full_name"];
    $address = $_POST["user_address"];

    // Update user info in database
    $sql = "UPDATE tbl_users SET user_full_name=?, user_address=? WHERE user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $fullName, $address, $userId);
    $stmt->execute();

    // Update session variables with new user info
    $_SESSION["user_full_name"] = $fullName;
    $_SESSION["user_address"] = $address;

    // redirect to product page
    echo "<script>window.location.href = '../pages/settings.php';</script>";
}
