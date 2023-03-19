<?php
$tab_title = "Welcome to UCLan Student Shop - Home Page";
require_once "../components/pageTop.component.php";
require_once "../components/connection.component.php";

$q = "SELECT * FROM tbl_products ORDER BY product_type";
$res = mysqli_query($conn, $q);
?>

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