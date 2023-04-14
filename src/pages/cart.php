<?php
$tab_title = "Welcome to UCLan Student Shop - Home Page";
require_once "../components/pageTop.component.php";

// check if the user is logged in
if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] == false) {
    // redirect to login page
    echo "<script>window.location.href = '../pages/login.php';</script>";
    exit();
}

if (isset($_SESSION["isCheckoutSuccess"]) && $_SESSION["isCheckoutSuccess"] == true) {
    echo '
<div class="mt-10 children:my-3">
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        Your order has been placed successfully!
    </div>
</div>';
    // unset session variable
    unset($_SESSION["isCheckoutSuccess"]);

    // empty the cart in local storage
    echo '
<script>
    localStorage.removeItem("cart");
</script>';
} else if (isset($_SESSION["isCheckoutSuccess"]) && $_SESSION["isCheckoutSuccess"] == false) {
    echo '
<div class="mt-10 children:my-3">
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        There was an error placing your order. Please try again.
    </div>
</div>';
    // unset session variable
    unset($_SESSION["isCheckoutSuccess"]);
}

?>

<div class="mt-10 children:my-3">
    <?php if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == true && isset($_SESSION["user_full_name"])) { ?>
        <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            Welcome back, <span class="text-uclan-red dark:text-uclan-yellow">
                <?php echo $_SESSION["user_full_name"] ?>
            </span>
        </div>
    <?php } ?>

    <div class="grid grid-cols-1 grid-rows-1 md:grid-cols-3" id="cart">
        <div class="w-full h-full col-span-2 px-4 py-4 bg-white rounded-lg lg:px-8 lg:py-14 md:px-6 md:py-8 dark:bg-gray-800">
            <div class="flex items-end justify-between w-full pt-3 mb-4 text-3xl font-bold leading-10 text-gray-800 lg:text-4xl dark:text-white">
                <span>Your Cart</span>
                <span onclick="clearCart()" class="text-sm cursor-pointer hover:underline h-fit text-uclan-red">Clear</span>
            </div>

            <div id="cart-items" class="overflow-y-scroll h-[90%] scrollbar scrollbar-thumb-uclan-red scrollbar-thumb-rounded scrollbar-track-gray-100 dark:scrollbar-track-gray-900">
                <!-- populated from js -->
            </div>
        </div>

        <div class="w-full h-full rounded-lg bg-blue-50 lg:w-96 md:w-8/12 dark:bg-gray-900">
            <div class="flex flex-col justify-between h-auto px-4 py-6 overflow-y-auto lg:h-screen lg:px-8 md:px-7 lg:py-20 md:py-10" id="sums">
                <div>
                    <p class="text-3xl font-bold leading-9 text-gray-800 lg:text-4xl dark:text-white">
                        Summary
                    </p>

                    <div class="flex items-center justify-between pt-16">
                        <p class="text-base leading-none text-gray-800 dark:text-white">
                            Subtotal
                        </p>

                        <p id="item-total" class="text-base leading-none text-gray-800 dark:text-white">
                            <!-- populated by js -->
                        </p>
                    </div>

                    <div class="flex items-center justify-between pt-5">
                        <p class="text-base leading-none text-gray-800 dark:text-white">
                            Shipping
                        </p>
                        <p id="shipping" class="text-base leading-none text-gray-800 dark:text-white">
                            <!-- populated by js -->
                        </p>
                    </div>

                    <div class="flex items-center justify-between pt-5">
                        <p class="text-base leading-none text-gray-800 dark:text-white">
                            Tax
                        </p>
                        <p id="tax" class="text-base leading-none text-gray-800 dark:text-white">
                            <!-- populated by js -->
                        </p>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between pt-20 pb-6 lg:pt-5">
                        <p class="text-2xl leading-normal text-gray-800 dark:text-white">Total</p>
                        <p id="total" class="text-2xl font-bold leading-normal text-right text-gray-800 dark:text-white">
                            <!-- populated by js -->
                        </p>
                    </div>

                    <form action="../actions/createOrder.php" method="post">
                        <input type="hidden" name="product_ids" id="product_ids">

                        <button type="submit" class="w-full py-5 text-base leading-none text-white bg-gray-800 border border-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 dark:hover:bg-gray-700">
                            Checkout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "../components/pageBottom.component.php"; ?>