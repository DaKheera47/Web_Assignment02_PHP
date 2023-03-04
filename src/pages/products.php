<?php
$tab_title = "Welcome to UCLan Student Shop - Home Page";
require_once "../components/pageTop.component.php";
require_once("../components/connection.component.php");

$q = "SELECT * FROM tbl_products ORDER BY product_type";
$res = mysqli_query($conn, $q);

?>

<h1 class="heading mt-8 mb-4">
    Products Page!
</h1>

<div class="my-4">
    <div class="inline-flex rounded-md shadow-sm" role="group">
        <button onclick="filterProducts('All')" class="dark:bg-gray-700 dark:text-white dark:hover:bg-gray-900 inline-flex items-center px-4 lg:px-8 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:outline-none dark:border-none">
            Display All
        </button>

        <button onclick="filterProducts('UCLan Logo Jumper')" class="dark:bg-gray-700 dark:text-white dark:hover:bg-gray-900 inline-flex items-center px-4 lg:px-8 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:outline-none dark:border-none">
            UCLan Logo Jumper
        </button>

        <button onclick="filterProducts('UCLan Logo Tshirt')" class="dark:bg-gray-700 dark:text-white dark:hover:bg-gray-900 inline-flex items-center px-4 lg:px-8 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:outline-none dark:border-none">
            UCLan Logo Tshirt
        </button>

        <button onclick="filterProducts('UCLan Hoodie')" class="dark:bg-gray-700 dark:text-white dark:hover:bg-gray-900 inline-flex items-center px-4 lg:px-8 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:outline-none dark:border-none">
            UCLan Hoodie
        </button>
    </div>
</div>

<div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
    <?php
    require_once '../components/productCard.component.php';

    while ($row = mysqli_fetch_array($res)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_price = $row['product_price'];
        $product_image = $row['product_image'];
        $product_desc = $row['product_desc'];
        $type = $row['product_type'];

        createCard($product_id, $product_title, $product_price, $product_image, $product_desc, $type);
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

<?php require_once "../components/pageBottom.component.php"; ?>