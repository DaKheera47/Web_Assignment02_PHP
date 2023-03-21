if (getLocalStorage("cart") == null) {
    document.getElementById("cartIcon").classList.add("hidden");
}

function addToCart(item) {
    let cart = getLocalStorage("cart");

    if (cart == null) {
        cart = [];
    }

    cart.push(item);

    let userUniqueCartItems = countDuplicateEntries(cart);

    setLocalStorage("cart", cart);
    setLocalStorage("formattedCart", userUniqueCartItems);
}

function countDuplicateEntries(arr) {
    const counts = arr.reduce((acc, curr) => {
        const key = `${curr.product_id}-${curr.product_type}`;
        if (!acc[key]) {
            acc[key] = {
                product: curr,
                count: 1,
            };
        } else {
            acc[key].count++;
        }
        return acc;
    }, {});

    return Object.values(counts);
}

function populateCart() {
    let cart = getLocalStorage("formattedCart");

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
    cart.forEach((cartItem) => {
        let item = cartItem.product;
        let count = cartItem.count;

        const htmlString = `
    <div id="${
        item.product_id
    }" class="md:pl-3 flex flex-col justify-center py-8 md:py-10 lg:py-8 border-t border-gray-50 mx-4">
        <div class="flex items-center justify-between w-full pt-1 space-x-4">
            <div class="w-[200px] md:block hidden">
                <img src="/~ssarfaraz/public/${item.product_image}" alt="${
            item.product_desc
        }" class="h-full object-center object-cover rounded-lg">
            </div>

            <p class="text-base font-black leading-none text-gray-800 dark:text-white">
                ${item.product_title}
            </p>

            <select id="item-count-${
                item.product_id
            }" aria-label="Select quantity" class="py-2 px-1 border border-gray-200 mr-6 focus:outline-none dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
                <option ${
                    count === 1 ? "selected" : "unselected"
                } value="1">01</option>
                <option ${
                    count === 2 ? "selected" : "unselected"
                } value="2">02</option>
                <option ${
                    count === 3 ? "selected" : "unselected"
                } value="3">03</option>
                <option ${
                    count === 4 ? "selected" : "unselected"
                } value="4">04</option>
                <option ${
                    count === 5 ? "selected" : "unselected"
                } value="5">05</option>
                <option ${
                    count === 6 ? "selected" : "unselected"
                } value="6">06</option>
                <option ${
                    count === 7 ? "selected" : "unselected"
                } value="7">07</option>
                <option ${
                    count === 8 ? "selected" : "unselected"
                } value="8">08</option>
                <option ${
                    count === 9 ? "selected" : "unselected"
                } value="9">09</option>
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
        let eItemCount = document.getElementById(
            `item-count-${item.product_id}`
        );

        // eItemCount.addEventListener("change", () => {
        //     calculateCheckout();
        //     // count how many of this item is in the cart
        //     let count = cart.filter((cartItem) => {
        //         return cartItem.product_id === item.product_id;
        //     }).length;
        //     console.log("🚀 ~ file: handleCart.js:169 ~ count ~ count:", count);
        // });

        // cast to int to avoid string concatenation
        itemTotal += parseInt(item.product_price * eItemCount.value);
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

    let userUniqueCartItems = countDuplicateEntries(cart);

    setLocalStorage("cart", cart);
    setLocalStorage("formattedCart", userUniqueCartItems);
    populateCart();
}

function calculateCartCount(item) {
    // get cart
    let cart = getLocalStorage("cart");

    // count how many of this item is in the cart
    let count = cart.filter((cartItem) => {
        return cartItem.product_id === item.product_id;
    }).length;

    cart.forEach((item) => {
        let eItemCount = document.getElementById(
            `item-count-${item.product_id}`
        );

        if (eItemCount === null) return;

        if (eItemCount.value > count) {
            let diff = eItemCount.value - count;
            for (let i = 0; i < diff; i++) {
                addToCart(item);
            }
        } else if (eItemCount.value < count) {
            let diff = count - eItemCount.value;
            for (let i = 0; i < diff; i++) {
                handleRemoveItem(item);
            }
        }

        calculateCheckout();
    });

    // eItemCount.addEventListener("change", () => {
}

// on page load
window.onload = () => {
    let cart = getLocalStorage("formattedCart");
    populateCart();

    cart.forEach((product) => {
        let item = product.product;

        let eItemCount = document.getElementById(
            `item-count-${item.product_id}`
        );

        if (eItemCount === null) return;

        eItemCount.addEventListener("change", () => {
            calculateCheckout();
            calculateCartCount();
        });
    });
};
