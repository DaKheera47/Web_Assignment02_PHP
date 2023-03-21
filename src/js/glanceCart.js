function populateCartGlance() {
    let cart = getLocalStorage("formattedCart");

    // remove all children from cart dropdown
    let cartItems = document.getElementById("cart-dropdown-list");
    while (cartItems.firstChild) {
        cartItems.removeChild(cartItems.firstChild);
    }

    cart.forEach((products) => {
        const items = products.product;
        const count = products.count;

        const htmlString = `
        <div class="flex justify-between items-center py-2 border-b border-gray-200">
            <div class="flex items-center space-x-2">
                <span class="inline-flex items-center justify-center w-4 h-4 ml-2 text-xs font-semibold text-uclan-blue bg-green-200 rounded-full">
                    ${count}
                </span>
                <span class="text-sm text-gray-900 dark:text-white">
                    ${items.product_title}
                </span>
            </div>
        </div>
`;

        cartItems.insertAdjacentHTML("beforeend", htmlString);
    });
}
