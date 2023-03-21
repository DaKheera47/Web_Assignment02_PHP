<?php
session_start();
require_once "../components/connection.component.php";
?>

<?php

// get post data
$submittedId = $_POST["product_id"];
$title = $_POST["review_title"];
$submittedComment = $_POST["review_desc"];
$submittedRating = $_POST["review_rating"];
$userId = $_SESSION["user_id"];

// add comment to database
$sql = "INSERT INTO tbl_reviews (product_id, user_id, review_title, review_desc, review_rating) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iisss", $submittedId, $userId, $title, $submittedComment, $submittedRating);
$stmt->execute();

// redirect to product page
echo "<script>window.location.href = '../pages/viewProduct.php?id=$submittedId';</script>";

?>