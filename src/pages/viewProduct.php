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

// get the percentage of each rating
$sql = "SELECT review_rating, COUNT(*) AS count FROM tbl_reviews WHERE product_id = ? GROUP BY review_rating";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $submittedId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // get reviews
    $ratings = $result->fetch_all(MYSQLI_ASSOC);
} else {
    // no comments
    $ratings = [];
}

// get number of ratings
$sql = "SELECT COUNT(*) AS count FROM tbl_reviews WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $submittedId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // get reviews
    $ratingCount = $result->fetch_assoc();
} else {
    // no comments
    $ratingCount = [];
}

// get average rating
$sql = "SELECT AVG(review_rating) AS avg FROM tbl_reviews WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $submittedId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // get reviews
    $avgRating = $result->fetch_assoc()["avg"];
} else {
    // no comments
    $avgRating = 0;
}

$totalReviews = 0;
$ratingPercentages = [];

foreach ($ratings as $rating) {
    $totalReviews += $rating['count'];
}

foreach ($ratings as $rating) {
    $ratingPercentages[$rating['review_rating']] = round(($rating['count'] / $totalReviews) * 100);
}


?>

<div class="grid grid-cols-1 pt-12 md:pt-0 md:grid-cols-2 children:mx-3">
    <div class="mt-3">
        <?php
        require_once '../components/productCard.component.php';
        createCard($product, $conn);
        ?>

        <div class="mb-8">
            <div class="flex items-center justify-center mb-3 md:justify-start">
                <?php
                // display the average rating, rounded to the top integer
                for ($i = 0; $i < ceil($avgRating); $i++) { ?>
                    <svg aria-hidden="true" class="w-5 h-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Star at postiion <?php echo $i + 1 ?></title>
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                <?php } ?>
                <p class="ml-2 text-sm font-medium text-center text-gray-900 md:text-left dark:text-white"><?php echo round($avgRating, 1) ?> out of 5</p>
            </div>

            <p class="text-sm font-medium text-center text-gray-500 md:text-left dark:text-gray-400">
                <?php echo $ratingCount["count"] ?> global rating<?php if ($ratingCount["count"] > 1)  echo "s"; ?>
            </p>

            <?php for ($i = 5; $i >= 1; $i--) : ?>
                <div class="flex items-center justify-center mt-4 md:justify-start">
                    <span class="text-sm font-medium text-blue-600 dark:text-blue-500"><?php echo $i; ?> star</span>
                    <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                        <div class="h-5 bg-yellow-400 rounded" style="width: <?php echo isset($ratingPercentages[$i]) ? $ratingPercentages[$i] : 0; ?>%"></div>
                    </div>
                    <span class="text-sm font-medium text-blue-600 dark:text-blue-500"><?php echo isset($ratingPercentages[$i]) ? $ratingPercentages[$i] . '%' : '0%'; ?></span>
                </div>
            <?php endfor; ?>

        </div>

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