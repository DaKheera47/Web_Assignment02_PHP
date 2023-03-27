<?php
$tab_title = "Welcome to UCLan Student Shop - Home Page";
require_once "../components/pageTop.component.php";
?>

<div class="mt-10 children:my-3">
    <?php
    if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == true && isset($_SESSION["user_full_name"])) { ?>
        <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            Welcome back, <span class="text-uclan-red dark:text-uclan-yellow">
                <?php echo $_SESSION["user_full_name"] ?>
            </span>
        </div>
    <?php } ?>

    <div class="grid grid-cols-1 grid-rows-1 md:grid-cols-3" id="cart">
        <div class="w-full h-full col-span-2 px-4 py-4 bg-white rounded-lg lg:px-8 lg:py-14 md:px-6 md:py-8 dark:bg-gray-800">
            <p class="pt-3 mb-4 text-3xl font-bold leading-10 text-gray-800 lg:text-4xl dark:text-white">
                Your Cart
            </p>

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

                    <button type="submit" class="w-full py-5 text-base leading-none text-white bg-gray-800 border border-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 dark:hover:bg-gray-700">
                        Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../js/handleCart.js"></script>

<?php require_once "../components/pageBottom.component.php"; ?>