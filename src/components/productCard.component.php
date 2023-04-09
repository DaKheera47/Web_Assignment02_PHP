<?php
function createCard($row, $conn)
{
    // get the average rating of the product from the product_rating column in the tbl_products table
    $sql = "SELECT AVG(review_rating) AS avg_rating FROM tbl_reviews WHERE product_id = ?";
    $stmt = $conn->prepare($sql);

    $id = $row['product_id'];
    $title = $row['product_title'];
    $price = $row['product_price'];
    $image = $row['product_image'];
    $desc = $row['product_desc'];
    $type = $row['product_type'];
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // get average rating
        $avgRating = $result->fetch_assoc()['avg_rating'];
    } else {
        // no comments
        $avgRating = 0;
    }
?>

    <div data-card="true" data-selector="<?php echo $type ?>" id="<?php echo $id ?>" class="w-full max-w-sm mb-8 bg-white border border-gray-200 rounded-lg shadow js-show-on-scroll h-fit productCard dark:bg-gray-800 dark:border-none">
        <img class="p-8 rounded-t-lg" src="/~ssarfaraz/public/<?php echo $image ?>" alt="<?php echo ucfirst(strtolower($desc)) ?>">

        <div class="px-5 pb-5">
            <form action="viewProduct.php">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <button type="submit" id="productTitle<?php echo $id ?>" class="text-xl font-semibold tracking-tight text-gray-900 link dark:text-white">
                    <?php echo $title ?>
                </button>
            </form>

            <?php if ($avgRating != 0) { ?>
                <div class="flex items-center mt-2.5 mb-5">
                    <?php
                    // display the average rating, rounded to the top integer
                    for ($i = 0; $i < ceil($avgRating); $i++) { ?>
                        <svg aria-hidden="true" class="w-5 h-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <title>Star at postiion <?php echo $i + 1 ?></title>
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    <?php } ?>
                    <span class="bg-blue-100 text-uclan-blue text-xs font-semibold mr-2 px-2.5 py-0.5 rounded ml-3">
                        <?php echo round($avgRating, 2) ?>
                    </span>
                </div>
            <?php } ?>

            <p class="my-4"><?php echo ucfirst(strtolower($desc)) ?></p>

            <div class="flex items-center justify-between">
                <span class="text-3xl font-bold text-gray-900 dark:text-white" id="productPrice<?php echo $id ?>">
                    €<?php echo $price ?>
                </span>

                <button onclick='addToCart(<?php echo $row["product_id"] ?>)' class="text-white bg-uclan-blue hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-uclan-blue font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Add to cart
                </button>
            </div>

        </div>
    </div>

<?php } ?>