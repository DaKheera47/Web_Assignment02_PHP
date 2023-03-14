if (getLocalStorage("cart") == null) {
    document.getElementById("cartIcon").classList.add("hidden");
}

function addToCart(id) {
    let cart = getLocalStorage("cart");

    console.log(id);

    if (cart == null) {
        cart = [];
    }

    cart.push(id);
    setLocalStorage("cart", cart);
}

function populateCartDropdown() {
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

    console.log(cart);

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

        // let productCount = document.createElement("span");
        // productCount.classList.add(
        //     "inline-flex",
        //     "items-center",
        //     "justify-center",
        //     "w-4",
        //     "h-4",
        //     "ml-2",
        //     "text-xs",
        //     "font-semibold",
        //     "text-blue-800",
        //     "bg-blue-200",
        //     "rounded-full"
        // );
        // productCount.innerHTML = count;

        let productTitle = document.createElement("span");
        productTitle.classList.add(
            "text-sm",
            "text-gray-900",
            "dark:text-white"
        );

        productTitle.innerHTML = items.product_title;

        // let productPrice = document.createElement("span");
        // productPrice.classList.add(
        //     "text-sm",
        //     "text-gray-500",
        //     "dark:text-gray-200"
        // );
        // productPrice.innerHTML = document.getElementById(
        //     "productPrice" + id
        // ).innerHTML;

        // contentDiv.appendChild(productCount);
        contentDiv.appendChild(productTitle);

        product.appendChild(contentDiv);
        // product.appendChild(productPrice);

        cartItems.appendChild(product);
    });
}
