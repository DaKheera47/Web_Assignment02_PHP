function populateCartGlance() {
    let cart = getLocalStorage("cart");

    // if (document.getElementById("cart-dropdown-error") != null) {
    //     document.getElementById("cart-dropdown-error").remove();
    // } else {
    // }

    let cartItems = document.getElementById("cart-dropdown-list");
    while (cartItems.firstChild) {
        cartItems.removeChild(cartItems.firstChild);
    }

    // if (cart == null || cart.length == 0) {
    //     let errorMessage = document.createElement("span");
    //     errorMessage.id = "cart-dropdown-error";

    //     errorMessage.classList.add(
    //         "text-sm",
    //         "font-medium",
    //         "text-white",
    //         "mx-auto"
    //     );
    //     errorMessage.innerHTML = "Your cart is empty";
    //     cartItems.appendChild(errorMessage);

    //     return;
    // }

    // const counts = cart.reduce((acc, item) => {
    //     acc[item] = (acc[item] || 0) + 1;
    //     return acc;
    // }, {});

    // const userUniqueCartItems = Object.keys(counts).map((key) => {
    //     return {
    //         id: Number(key),
    //         count: counts[key],
    //     };
    // });

    // console.log(userUniqueCartItems);

    cart.forEach((items) => {
        let product = document.createElement("div");
        product.classList.add(
            "flex",
            "justify-between",
            "items-center",
            "px-4",
            "py-2",
            "border-b",
            "border-gray-200",
            "space-x-4"
        );

        let contentDiv = document.createElement("div");
        contentDiv.classList.add("flex", "items-center", "space-x-2");

        let productTitle = document.createElement("span");
        productTitle.classList.add(
            "text-sm",
            "text-gray-900",
            "dark:text-white"
        );

        productTitle.innerHTML = items.product_title;

        contentDiv.appendChild(productTitle);

        product.appendChild(contentDiv);
        cartItems.appendChild(product);
    });
}
