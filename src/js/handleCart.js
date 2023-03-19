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

function populateCart() {
    let cart = getLocalStorage("cart");

    // clear cart before populating
    const targetElement = document.getElementById("cart-items");
    targetElement.innerHTML = "";

    if (cart == null || cart.length == 0) {
        targetElement.innerHTML = `
        <div class="flex flex-col justify-center items-center py-8 md:py-10 lg:py-8 border-t border-gray-50 mx-4">
            <p class="text-base leading-none text-gray-800 dark:text-white">
                Your cart is empty, add some items to it.
            </p>

            <a href="./products.php" class="mt-4 text-sm font-medium link">
                View products
            </a>
        </div>
        `;
        return;
    }

    // for each item in cart
    cart.forEach((item) => {
        const htmlString = `
    <div class="md:pl-3 flex flex-col justify-center py-8 md:py-10 lg:py-8 border-t border-gray-50 mx-4">
        <div class="flex items-center justify-between w-full pt-1 space-x-4">
            <div class="w-[200px] md:block hidden">
                <img src="/~ssarfaraz/public/${item.product_image}" alt="${
            item.product_desc
        }" class="h-full object-center object-cover rounded-lg">
            </div>

            <p class="text-base font-black leading-none text-gray-800 dark:text-white">
                ${item.product_title}
            </p>

            <select aria-label="Select quantity" class="py-2 px-1 border border-gray-200 mr-6 focus:outline-none dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
                <option>01</option>
                <option>02</option>
                <option>03</option>
                <option>04</option>
                <option>05</option>
                <option>06</option>
                <option>07</option>
                <option>08</option>
                <option>09</option>
            </select>
        </div>

        <p class="text-sm text-gray-600 dark:text-white pt-2">
            ${item.product_desc}
        </p>

        <div class="flex items-center justify-between pt-5">
            <p class="text-sm leading-3 hover:underline hover:underline-offset-4 text-gray-800 dark:text-white cursor-pointer">
                Add to favorites
            </p>
            <p onclick='handleRemoveItem(${JSON.stringify(
                item
            )})' class="text-sm leading-3 hover:underline hover:underline-offset-4 text-red-500 pl-5 cursor-pointer">
                Remove
            </p>
            <p class="text-base font-black leading-none text-gray-800 dark:text-white">
                €${item.product_price}
            </p>
        </div>
    </div>`;

        // add the container to the page
        if (!!targetElement) {
            targetElement.innerHTML += htmlString;
        }
    });

    calculateCheckout();
}

function calculateCheckout() {
    let cart = getLocalStorage("cart");
    let itemTotal = 0;
    let taxPc = 0.21;
    let shippingPc = 0.1;

    let eItemTotal = document.getElementById("item-total");
    let eTax = document.getElementById("tax");
    let eShipping = document.getElementById("shipping");
    let eTotal = document.getElementById("total");

    if (cart === null || cart.length === 0) {
        eItemTotal.innerHTML = `€0`;
        eTax.innerHTML = `€0`;
        eShipping.innerHTML = `€0`;
        eTotal.innerHTML = `€0`;
        return;
    }

    cart.forEach((item) => {
        // cast to int to avoid string concatenation
        itemTotal += parseInt(item.product_price);
    });

    let tax = itemTotal * taxPc;
    let shipping = itemTotal * shippingPc;

    eItemTotal.innerHTML = `€${round(itemTotal)}`;
    eTax.innerHTML = `€${round(tax)}`;
    eShipping.innerHTML = `€${round(shipping)}`;

    let total = itemTotal + tax + shipping;
    eTotal.innerHTML = `€${round(total)}`;
}

function handleRemoveItem(item) {
    // get the cart from local storage
    let cart = getLocalStorage("cart");

    // make list of just the ids
    let cartIds = cart.map((item) => item.id);

    // get the index of the item to remove
    let index = cartIds.indexOf(item.id);

    // remove the item from the cart
    cart.splice(index, 1);

    setLocalStorage("cart", cart);
    populateCart();
}

// on page load
populateCart();
