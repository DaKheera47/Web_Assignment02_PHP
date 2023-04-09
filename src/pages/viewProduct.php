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

// get product reviews
$sql = "SELECT * FROM tbl_reviews WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $submittedId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // get reviews
    $comments = $result->fetch_all(MYSQLI_ASSOC);
} else {
    // no comments
    $comments = [];
}

?>

<div class="grid grid-cols-1 pt-12 md:pt-0 md:grid-cols-2 children:mx-3">
    <div class="mt-3">
        <?php
        require_once '../components/productCard.component.php';
        createCard($product, $conn);
        ?>
    </div>

    <div>
        <?php
        require_once '../components/productComment.component.php';

        // if there are no comments
        if (count($comments) == 0) {
            echo "<div class='w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600'>
                    <div class='px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800'>
                        <h3 class='text-sm text-gray-900 dark:text-white'>
                        No comments yet. Be the first one to write about " . $product['product_title'] . "!
                        </h3>
                    </div>
                </div>";
        }

        // flip comments array so that the most recent comment is at the top
        $comments = array_reverse($comments);
        for ($i = 0; $i < count($comments); $i++) {
            createComment($comments[$i]);
        }
        ?>

        <?php if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == true) { ?>
            <form class="w-full" method="POST" action="../actions/postComment.php">
                <input type="hidden" name="product_id" value="<?php echo $product["product_id"]; ?>">

                <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                    <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                        <!-- TODO Stars for choosing a rating -->
                        <label for="review_rating" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Select your Rating</label>
                        <select required id="review_rating" name="review_rating" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full mb-2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>

                        <hr class="h-px my-4 bg-gray-700 dark:bg-gray-400">

                        <label for="review_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Comment Title</label>
                        <input type="text" name="review_title" id="review_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Short Sentence" required>

                        <label class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white" for="review_desc">Your Comment</label>
                        <textarea id="review_desc" name="review_desc" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 mb-4 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write a comment here..." required></textarea>
                    </div>

                    <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                        <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                            Post comment
                        </button>
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>
</div>

<?php require_once "../components/pageBottom.component.php"; ?>