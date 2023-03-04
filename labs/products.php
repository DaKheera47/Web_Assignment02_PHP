<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <link rel="stylesheet" href="./output.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vite App</title>
</head>

<body>
    <!-- navbar -->
    <?php
    include './src/components/navbar.component.php';
    createNav();
    ?>

    <!-- db connection -->
    <?php
    $host = "localhost";
    $user = "ssarfaraz";
    $pass = "xUCeLzDv";
    $db = "ssarfaraz";
    $conn = mysqli_connect($host, $user, $pass, $db);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $q = "SELECT * FROM tbl_products ORDER BY product_type";
    $res = mysqli_query($conn, $q);

    ?>

    <main class="px-[5vw] xl:px-[0] max-w-screen-xl w-full mx-auto flex justify-center items-start flex-wrap flex-col">
        <h1 class="text-4xl font-bold text-uclan-blue mt-8 mb-4">
            Products Page!
        </h1>

        <div class="my-4">
            <div class="inline-flex rounded-md shadow-sm" role="group">
                <button onclick="filterProducts('All')" class="inline-flex items-center px-4 lg:px-8 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                    Display All
                </button>

                <button onclick="filterProducts('UCLan Logo Jumper')" class="inline-flex items-center px-4 lg:px-8 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                    UCLan Logo Jumper
                </button>

                <button onclick="filterProducts('UCLan Logo Tshirt')" class="inline-flex items-center px-4 lg:px-8 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                    UCLan Logo Tshirt
                </button>

                <button onclick="filterProducts('UCLan Hoodie')" class="inline-flex items-center px-4 lg:px-8 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                    UCLan Hoodie
                </button>
            </div>
        </div>

        <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            <?php
            include './src/components/productCard.component.php';

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
    </main>

    <!-- footer -->
    <?php
    include './src/components/footer.component.php';
    createFooter();
    ?>

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

</body>

</html>