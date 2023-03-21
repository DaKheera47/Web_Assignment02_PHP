<?php
$tab_title = "Welcome to UCLan Student Shop - Home Page";
require_once "../components/pageTop.component.php";
?>

<?php
if (isset($_GET["id"])) {
    $submittedId = htmlspecialchars($_GET["id"]);

    // check if id is a number
    if (is_numeric($submittedId)) {
        $sql = "SELECT * FROM tbl_products WHERE product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $submittedId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // get product
            $product = $result->fetch_assoc();
        } else {
            // product doesnt exist
            $_SESSION["error"] = "Product does not exist";

            echo "<script>window.location.href = 'products.php';</script>";
        }
    } else {
        // id is not a number
        $_SESSION["error"] = "Invalid product id";

        echo "<script>window.location.href = 'products.php';</script>";
    }
} else {
    // id was not submitted
    $_SESSION["error"] = "Please select a product to view";
    echo "<script>window.location.href = 'products.php';</script>";
}

?>

<div class="flex w-full justify-center items-center">
    <?php
    require_once '../components/productCard.component.php';

    createCard($product);
    ?>
</div>

<?php require_once "../components/pageBottom.component.php"; ?>
