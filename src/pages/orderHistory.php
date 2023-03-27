<?php
$tab_title = "Profile Page - UCLan Student Shop";
require_once "../components/pageTop.component.php";

// check if user is logged in
if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] == false) {
    echo "<script>window.location.href = '../pages/login.php';</script>";
}

// get user data
$sql = "SELECT * FROM tbl_users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION["user_id"]);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// get user orders
$sql = "SELECT * FROM tbl_orders WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION["user_id"]);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);

// loop through orders
for ($i = 0; $i < count($orders); $i++) {
    $split = explode(",", $orders[$i]["product_ids"]);

    // loop through products in order
    for ($j = 0; $j < count($split); $j++) {
        $sql = "SELECT * FROM tbl_products WHERE product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $split[$j]);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        // add product to order
        $orders[$i]["products"][] = $product;
    }
}

require_once '../components/productCard.component.php';
?>

<div class="pt-12">
    <h1 class="heading">Order History</h1>

    <p class="mt-4">
        Here is the order history for <?php echo $_SESSION["user_full_name"] ?>
    </p>

    <?php
    // loop through orders
    for ($i = 0; $i < count($orders); $i++) { ?>
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col">
                <div class="h-1 overflow-hidden bg-gray-800 rounded">
                    <div class="w-24 h-full bg-yellow-500"></div>
                </div>

                <div class="flex flex-col flex-wrap py-6 mb-12 sm:flex-row">
                    <h1 class="mb-2 text-2xl font-medium sm:w-2/5 title-font sm:mb-0">
                        #<?php echo date(strtotime($orders[$i]["order_date"]));
                            echo $orders[$i]["order_id"]; ?>
                    </h1>

                    <p class="pl-0 text-base leading-relaxed sm:w-3/5 sm:pl-10">
                        <!-- https://stackoverflow.com/a/19152398 -->
                        <!-- https://www.php.net/manual/en/datetime.format.php -->
                        Ordered at <?php echo date("g i a \o\\n jS F, Y", strtotime($orders[$i]["order_date"]))  ?>
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap gap-5">
                <?php
                // print all products
                for ($j = 0; $j < count($orders[$i]["products"]); $j++) {
                    $product = $orders[$i]["products"][$j];
                    createCard($product, $conn);
                }
                ?>
            </div>
        </div>
    <?php } ?>
</div>

<script src="../js/handleCart.js"></script>
<script src="../js/handleProductCard.js"></script>
<?php require_once "../components/pageBottom.component.php"; ?>