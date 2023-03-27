<?php
session_start();
require_once "../components/connection.component.php";

// get post data
$product_ids = $_POST["product_ids"];
$userId = $_SESSION["user_id"];
$orderDate = date("Y-m-d H:i:s");

// add comment to database
$sql = "INSERT INTO tbl_orders (order_date, user_id, product_ids) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $orderDate, $userId, $product_ids);
$stmt->execute();

// if successful, redirect to products page
if ($stmt->affected_rows > 0) {
    $_SESSION["isCheckoutSuccess"] = true;
    echo "<script>window.location.href = '../pages/cart.php';</script>";
} else {
    $_SESSION["isCheckoutSuccess"] = false;
    echo "<script>window.location.href = '../pages/cart.php';</script>";
}
