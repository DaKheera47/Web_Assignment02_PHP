<?php
$tab_title = "Welcome to UCLan Student Shop - Home Page";
require_once "../components/pageTop.component.php";
require_once "../components/connection.component.php";

$q = "SELECT * FROM tbl_products ORDER BY product_type";
$res = mysqli_query($conn, $q);

if (isset($_SESSION["error"]) && !empty($_SESSION["error"])) { ?>
    <div id="error-banner" tabindex="-1" class="fixed top-16 left-0 z-50 flex justify-between w-full p-4 bg-red-200 dark:bg-red-900">
        <div class="flex items-center mx-auto">
            <p class="flex items-center text-sm font-normal text-gray-800 dark:text-white">
                <span>
                    <?php echo $_SESSION["error"]; ?>
                </span>
            </p>
        </div>

        <div class="flex items-center">
            <button data-dismiss-target="#error-banner" type="button" class="flex-shrink-0 inline-flex justify-center items-center text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 dark:hover:bg-gray-600 dark:hover:text-white">
                <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close banner</span>
            </button>
        </div>
    </div>

<?php }; $_SESSION["error"] = ""; ?>



<h1 class="mt-8 mb-4 heading">
    You can view all our available products here
</h1>

<div class="my-4">
    <div class="grid flex-wrap items-center justify-center grid-cols-2 grid-rows-2 gap-2 rounded-md shadow-sm sm:inline-flex sm:gap-0 sm:flex-nowrap">
        <button onclick="filterProducts('All')" class="inline-flex items-center w-full px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 rounded-l-lg sm:text-left whitespace-nowrap dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 lg:px-8 hover:bg-gray-100 hover:text-uclan-yellow focus:z-10 focus:ring-2 focus:ring-uclan-yellow focus:text-uclan-yellow dark:outline-none dark:border-none">
            Display All
        </button>

        <button onclick="filterProducts('UCLan Logo Jumper')" class="inline-flex items-center w-full px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 sm:text-left whitespace-nowrap dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 lg:px-8 hover:bg-gray-100 hover:text-uclan-yellow focus:z-10 focus:ring-2 focus:ring-uclan-yellow focus:text-uclan-yellow dark:outline-none dark:border-none">
            UCLan Logo Jumper
        </button>

        <button onclick="filterProducts('UCLan Logo Tshirt')" class="inline-flex items-center w-full px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border-t border-b border-gray-200 sm:text-left whitespace-nowrap dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 lg:px-8 hover:bg-gray-100 hover:text-uclan-yellow focus:z-10 focus:ring-2 focus:ring-uclan-yellow focus:text-uclan-yellow dark:outline-none dark:border-none">
            UCLan Logo Tshirt
        </button>

        <button onclick="filterProducts('UCLan Hoodie')" class="inline-flex items-center w-full px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 sm:text-left whitespace-nowrap dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 lg:px-8 rounded-r-md hover:bg-gray-100 hover:text-uclan-yellow focus:z-10 focus:ring-2 focus:ring-uclan-yellow focus:text-uclan-yellow dark:outline-none dark:border-none">
            UCLan Hoodie
        </button>
    </div>
</div>

<!-- <div class="grid w-full grid-cols-1 gap-4"> -->
<div class="grid w-full grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
    <?php
    require_once '../components/productCard.component.php';

    // print all products

    while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {

        // echo "<pre class=\"monospace\">";
        // foreach($row as $x => $x_value) {
        //     echo "Key=" . $x . ", Value=" . $x_value;
        //     echo "<br>";
        // }
        // echo "</pre>";

        createCard($row);
    }
    ?>
</div>

<script>
    function filterProducts(type) {
        if (type == "All") {
            let products = document.getElementsByClassName("productCard");

            for (let i = 0; i < products.length; i++) {
                products[i].style.display = "block";
            }
            return;
        }

        let products = document.getElementsByClassName("productCard");

        for (let i = 0; i < products.length; i++) {
            if (products[i].getAttribute("data-selector") == type) {
                products[i].style.display = "block";
            } else {
                products[i].style.display = "none";
            }
        }
    }
</script>

<script src="../js/handleCart.js"></script>
<?php require_once "../components/pageBottom.component.php"; ?>