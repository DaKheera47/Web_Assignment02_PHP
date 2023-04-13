<?php
$tab_title = "Welcome to UCLan Student Shop - Home Page";
require_once "../components/pageTop.component.php";
require_once "../components/connection.component.php";

if (isset($_GET['sort']) && $_GET['sort'] != "All") {
    $sort = htmlspecialchars($_GET['sort']);
    // prepare a query
    $sql = "SELECT * FROM tbl_products WHERE product_type = ? ORDER BY product_type";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $sort);
} else {
    // prepare a query
    $sql = "SELECT * FROM tbl_products ORDER BY product_type";
    $stmt = $conn->prepare($sql);
}

// search_query
if (isset($_GET['search_query']) && !empty($_GET['search_query'])) {
    $search_query = htmlspecialchars($_GET['search_query']);
    // prepare a query
    $sql = "SELECT * FROM tbl_products WHERE product_title LIKE ? OR product_type LIKE ? ORDER BY product_type";
    $stmt = $conn->prepare($sql);
    $search_query = "%" . $search_query . "%";
    $stmt->bind_param("ss", $search_query, $search_query);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // get reviews
    $products = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $products = [];
    $_SESSION["error"] = "No products found or invalid product type";
}

if (isset($_SESSION["error"]) && !empty($_SESSION["error"])) { ?>
    <div id="error-banner" tabindex="-1" class="fixed left-0 z-50 flex justify-between w-full p-4 bg-red-200 top-16 dark:bg-red-900">
        <div class="flex items-center mx-auto">
            <a href="./products.php" class="flex items-center space-x-2 text-sm font-normal text-gray-800 dark:text-white">
                <span>
                    <?php echo $_SESSION["error"]; ?>
                </span>

                <span class="link">
                    Click here to reset
                </span>
            </a>
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
<?php };

$_SESSION["error"] = "";

if ($result->num_rows > 0) { ?>

    <?php if (isset($_GET['search_query']) && !empty($_GET['search_query'])) {
        $search_query = htmlspecialchars($_GET['search_query']); ?>
        <h2 class='mb-4 text-2xl capitalize text-uclan-yellow'>Showing Search results for: <?php echo $search_query ?> </h2>
    <?php } else if (isset($_GET['sort']) && !empty($_GET['sort'])) { ?>
        <h2 class='mb-4 text-2xl capitalize text-uclan-yellow'>
            Showing <?php echo $_GET['sort'] ?> Products
        </h2>
    <?php } else { ?>
        <h2 class='mb-4 text-2xl capitalize text-uclan-yellow'>
            Showing all products
        </h2>
    <?php } ?>

    <div class="my-4">
        <div class="grid flex-wrap items-center justify-center grid-cols-2 grid-rows-2 gap-2 rounded-md shadow-sm sm:inline-flex sm:gap-0 sm:flex-nowrap">
            <form>
                <input type="hidden" name="sort" value="All">

                <button type="submit" class="inline-flex items-center w-full px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 rounded-l-lg sm:text-left whitespace-nowrap dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 lg:px-8 hover:bg-gray-100 hover:text-uclan-yellow focus:ring-2 focus:ring-uclan-yellow focus:text-uclan-yellow dark:outline-none dark:border-none">
                    Display All
                </button>
            </form>

            <form>
                <input type="hidden" name="sort" value="UCLan Logo Jumper">

                <button type="submit" class="inline-flex items-center w-full px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 sm:text-left whitespace-nowrap dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 lg:px-8 hover:bg-gray-100 hover:text-uclan-yellow focus:ring-2 focus:ring-uclan-yellow focus:text-uclan-yellow dark:outline-none dark:border-none">
                    UCLan Logo Jumper
                </button>
            </form>

            <form>
                <input type="hidden" name="sort" value="UCLan Logo Tshirt">

                <button type="submit" class="inline-flex items-center w-full px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border-t border-b border-gray-200 sm:text-left whitespace-nowrap dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 lg:px-8 hover:bg-gray-100 hover:text-uclan-yellow focus:ring-2 focus:ring-uclan-yellow focus:text-uclan-yellow dark:outline-none dark:border-none">
                    UCLan Logo Tshirt
                </button>
            </form>

            <form>
                <input type="hidden" name="sort" value="UCLan Hoodie">

                <button type="submit" class="inline-flex items-center w-full px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 sm:text-left whitespace-nowrap dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 lg:px-8 rounded-r-md hover:bg-gray-100 hover:text-uclan-yellow focus:ring-2 focus:ring-uclan-yellow focus:text-uclan-yellow dark:outline-none dark:border-none">
                    UCLan Hoodie
                </button>
            </form>
        </div>
    </div>

    <form class="my-4">
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            <input type="search" name="search_query" id="default-search" class="z-50 block w-full p-4 pl-10 text-sm text-gray-900 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Mockups, Logos..." required>
            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
        </div>
    </form>

    <!-- <div class="grid w-full grid-cols-1 gap-4"> -->
    <div class="grid w-full grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        <?php
        require_once '../components/productCard.component.php';

        // print all products
        foreach ($products as $product) {
            createCard($product, $conn);
        }

        ?>
    </div>

<?php } ?>

<?php require_once "../components/pageBottom.component.php"; ?>