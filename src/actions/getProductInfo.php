<?php
require_once "../components/connection.component.php";

// print all post variables
// get the product id from the post variable
$id = $_POST['product_id'];

// get the product info from the database
$sql = "SELECT * FROM tbl_products WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// if the product exists
if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
}
