function populateCartGlance() {
    let cart = getLocalStorage("cart");

    // remove all children from cart dropdown
    let cartItems = document.getElementById("cart-dropdown-list");
    while (cartItems.firstChild) {
        cartItems.removeChild(cartItems.firstChild);
    }

    // if cart is empty, show empty message
    if (cart.length === 0) {
        const htmlString = `
        <div class="flex justify-between text-center items-center py-2 border-b border-gray-200">
            <div class="flex items-center space-x-2 w-full justify-center">
                <span class="text-sm text-gray-900 dark:text-white">
                    Your cart is empty
                </span>
            </div>
        </div>
`;

        cartItems.insertAdjacentHTML("beforeend", htmlString);
        return;
    }

    // remove duplicates
    let uniqueCartIds = [...new Set(cart)];

    let products = [];

    // get the product info for each item in the cart
    uniqueCartIds.forEach(async (id) => {
        let data = { product_id: id };

        // convert object to url params
        let params = new URLSearchParams(data).toString();
        let url = "../actions/getProductInfo.php";

        const output = await usePHP(params, url).catch((error) => {
            console.error(error);
        });

        products.push(JSON.parse(output));

        const eTarget = document.getElementById("cart-items");
        if (eTarget) {
            eTarget.innerHTML = "";
        }

        // count duplicates using the fucntion
        let productCounts = countDuplicateEntries(cart);

        // for each item in cart
        products.forEach((cartItem) => {
            let item = cartItem;

            const htmlString = `
            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                <div class="flex items-center space-x-2">
                    <span class="inline-flex items-center justify-center w-4 h-4 ml-2 text-xs font-semibold text-uclan-blue bg-green-200 rounded-full">
                    ${
                        productCounts.find(
                            (x) => x.productId === item.product_id
                        )["count"]
                    }
                    </span>
                    <span class="text-sm text-gray-900 dark:text-white">
                        ${item.product_title}
                    </span>
                </div>
            </div>
`;

            cartItems.insertAdjacentHTML("beforeend", htmlString);
        });
    });
}
