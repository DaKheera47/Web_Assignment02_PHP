<?php
$tab_title = "Welcome to UCLan Student Shop - Home Page";
require_once "../components/pageTop.component.php";
require_once "../components/connection.component.php";

$q = "SELECT * FROM tbl_products ORDER BY product_type";
$res = mysqli_query($conn, $q);
?>

<h1 class="heading mt-8 mb-4">
    You can view all our available products here
</h1>

<div class="my-4">
    <div class="sm:inline-flex grid grid-cols-2 grid-rows-2 justify-center items-center gap-2 sm:gap-0 flex-wrap sm:flex-nowrap rounded-md shadow-sm">
        <button onclick="filterProducts('All')" class="w-full text-center sm:text-left whitespace-nowrap dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 inline-flex items-center px-4 lg:px-8 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-100 hover:text-uclan-yellow focus:z-10 focus:ring-2 focus:ring-uclan-yellow focus:text-uclan-yellow dark:outline-none dark:border-none">
            Display All
        </button>

        <button onclick="filterProducts('UCLan Logo Jumper')" class="w-full text-center sm:text-left whitespace-nowrap dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 inline-flex items-center px-4 lg:px-8 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 hover:text-uclan-yellow focus:z-10 focus:ring-2 focus:ring-uclan-yellow focus:text-uclan-yellow dark:outline-none dark:border-none">
            UCLan Logo Jumper
        </button>

        <button onclick="filterProducts('UCLan Logo Tshirt')" class="w-full text-center sm:text-left whitespace-nowrap dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 inline-flex items-center px-4 lg:px-8 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-uclan-yellow focus:z-10 focus:ring-2 focus:ring-uclan-yellow focus:text-uclan-yellow dark:outline-none dark:border-none">
            UCLan Logo Tshirt
        </button>

        <button onclick="filterProducts('UCLan Hoodie')" class="w-full text-center sm:text-left whitespace-nowrap dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 inline-flex items-center px-4 lg:px-8 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-md hover:bg-gray-100 hover:text-uclan-yellow focus:z-10 focus:ring-2 focus:ring-uclan-yellow focus:text-uclan-yellow dark:outline-none dark:border-none">
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

<script src="../js/useLocalStorage.js"></script>
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

    if (getLocalStorage("cart") == null) {
        document.getElementById("cartIcon").classList.add("hidden");
    }

    function addToCart(id) {
        let cart = getLocalStorage("cart");

        if (cart == null) {
            cart = [];
        }

        cart.push(id);
        setLocalStorage("cart", cart);
    }

    function populateCartDropdown() {
        let cart = getLocalStorage("cart");
        let cartItems = document.getElementById("cart-dropdown-list");

        if (document.getElementById("cart-dropdown-error") != null) {
            document.getElementById("cart-dropdown-error").remove();
        } else {
            let cartItems = document.getElementById("cart-dropdown-list");
            while (cartItems.firstChild) {
                cartItems.removeChild(cartItems.firstChild);
            }
        }

        if (cart == null || cart.length == 0) {
            let errorMessage = document.createElement("span");
            errorMessage.id = "cart-dropdown-error";

            errorMessage.classList.add("text-sm", "font-medium", "text-white", "mx-auto");
            errorMessage.innerHTML = "Your cart is empty";
            cartItems.appendChild(errorMessage);

            return;
        }

        const counts = cart.reduce((acc, item) => {
            acc[item] = (acc[item] || 0) + 1;
            return acc;
        }, {});

        const userUniqueCartItems = Object.keys(counts).map((key) => {
            return {
                id: Number(key),
                count: counts[key]
            };
        });

        userUniqueCartItems.forEach(({
            id,
            count
        }) => {
            let product = document.createElement("div");
            product.classList.add("flex", "justify-between", "items-center", "px-4", "py-2", "border-b", "border-gray-200", "space-x-4");

            let contentDiv = document.createElement("div");
            contentDiv.classList.add("flex", "items-center", "space-x-2");

            let productCount = document.createElement("span");
            productCount.classList.add("inline-flex", "items-center", "justify-center", "w-4", "h-4", "ml-2", "text-xs", "font-semibold", "text-blue-800", "bg-blue-200", "rounded-full");
            productCount.innerHTML = count;

            let productTitle = document.createElement("span");
            productTitle.classList.add("text-sm", "font-medium", "text-gray-900", "dark:text-white");
            productTitle.innerHTML = document.getElementById("productTitle" + id).innerHTML;

            let productPrice = document.createElement("span");
            productPrice.classList.add("text-sm", "text-gray-500", "dark:text-gray-200");
            productPrice.innerHTML = document.getElementById("productPrice" + id).innerHTML;

            contentDiv.appendChild(productCount);
            contentDiv.appendChild(productTitle);

            product.appendChild(contentDiv);
            product.appendChild(productPrice);

            cartItems.appendChild(product);
        })
    }
</script>

<?php require_once "../components/pageBottom.component.php"; ?>