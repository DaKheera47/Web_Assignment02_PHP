function countDuplicateEntries(arr) {
    const counts = arr.reduce((acc, curr) => {
        const key = curr;

        if (!acc[key]) {
            acc[key] = {
                productId: curr,
                count: 1,
            };
        } else {
            acc[key].count++;
        }
        return acc;
    }, {});

    return Object.values(counts);
}

function calculateCheckoutValues(productData) {
    let itemTotal = 0;
    let taxPc = 0.21;
    let shippingPc = 0.1;

    let eItemTotal = document.getElementById("item-total");
    let eTax = document.getElementById("tax");
    let eShipping = document.getElementById("shipping");
    let eTotal = document.getElementById("total");

    if (productData === null || productData.length === 0) {
        eItemTotal.innerHTML = `€0`;
        eTax.innerHTML = `€0`;
        eShipping.innerHTML = `€0`;
        eTotal.innerHTML = `€0`;
        return;
    }

    productData.forEach((item) => {
        let eItemCount = document.getElementById(
            `item-count-${item.product_id}`
        );

        if (eItemCount) {
            // cast to int to avoid string concatenation
            itemTotal += parseInt(
                item.product_price * parseInt(eItemCount.textContent)
            );
        }
    });

    let tax = itemTotal * taxPc;
    let shipping = itemTotal * shippingPc;

    if (eItemTotal) {
        eItemTotal.innerHTML = `€${round(itemTotal)}`;
    }
    if (eTax) {
        eTax.innerHTML = `€${round(tax)}`;
    }
    if (eShipping) {
        eShipping.innerHTML = `€${round(shipping)}`;
    }

    let total = itemTotal + tax + shipping;
    if (eTotal) {
        eTotal.innerHTML = `€${round(total)}`;
    }
}

function setHiddenInput(cart) {
    let eCart = document.getElementById("product_ids");
    if (eCart) {
        eCart.value = cart;
    }
}

async function addToCart(id) {
    if (!(await isLoggedIn())) {
        return;
    }

    let cart = getLocalStorage("cart");

    // If the cart is empty, set it to an empty array.
    if (cart === null) {
        cart = [];
    }

    cart.push(id);

    setLocalStorage("cart", cart);
    handleButtonColor();
}

async function handleRemoveItem(id) {
    if (!(await isLoggedIn())) {
        return;
    }

    let cart = getLocalStorage("cart");

    // If the cart is empty, set it to an empty array.
    if (cart === null) {
        cart = [];
    }

    // Find the index of the item with the given id
    const itemIndex = cart.findIndex((item) => item === id);

    // Remove the item from the cart if found
    if (itemIndex !== -1) {
        cart.splice(itemIndex, 1);
    }

    setLocalStorage("cart", cart);
    renderCartItems();
}

function handleButtonColor() {
    // get cart using useLocalStorage hook
    let cart = getLocalStorage("cart");

    // get all products with data-card="true" attribute
    const products = document.querySelectorAll('[data-card="true"]');

    // loop through all products
    products.forEach((product) => {
        // for each item in cart
        cart.forEach((cartItem) => {
            // if product is also in the cart, if it includes the product id which is in the id attribute
            if (cartItem == product.id) {
                // get the button
                const eButton = product.getElementsByTagName("button")[1];

                // add the class
                eButton.classList.add("!bg-green-500");
                eButton.classList.add("hover:!bg-green-600");
            }
        });
    });
}

async function renderCartItems() {
    let cart = getLocalStorage("cart");
    setHiddenInput(cart);

    const eTarget = document.getElementById("cart-items");
    if (eTarget) {
        eTarget.innerHTML = "";
    }

    if (cart === null || cart.length === 0) {
        eTarget.innerHTML = `
                    <div class="flex flex-col justify-center items-center py-8 md:py-10 lg:py-8 border-t border-gray-50 mx-4">
                        <p class="text-base leading-none text-gray-800 dark:text-white">
                            Your cart is empty, add some items to it.
                        </p>

                        <a href="./products.php" class="mt-4 text-sm font-medium link">
                            View products
                        </a>
                    </div>
`;
        calculateCheckoutValues([]);
        return;
    }

    // count how many of each item is in the cart
    let userUniqueCartItems = countDuplicateEntries(cart);

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

        // for each item in cart
        products.forEach((cartItem) => {
            let item = cartItem;

            const htmlString = `
                <div id="${
                    item.product_id
                }" class="md:pl-3 flex flex-col justify-center py-8 md:py-10 lg:py-8 border-t border-gray-50 mx-4">
                    <div class="flex items-center justify-between w-full pt-1 space-x-4">
                        <div class="w-[200px] md:block hidden">
                            <img src="/~ssarfaraz/public/${
                                item.product_image
                            }" alt="${
                item.product_desc
            }" class="h-full object-center object-cover rounded-lg">
                        </div>

                        <p class="text-base font-bold leading-none text-gray-800 dark:text-white">
                            ${item.product_id} - ${item.product_title}
                        </p>

                        <p id="item-count-${
                            item.product_id
                        }" class="text-base font-bold leading-none text-gray-800 dark:text-white">
                            ${
                                userUniqueCartItems.find(
                                    (x) => x.productId === item.product_id
                                )["count"]
                            }
                        </p>
                    </div>

                    <p class="text-sm text-gray-600 dark:text-white pt-2">
                        ${item.product_desc}
                    </p>

                    <div class="flex items-center justify-between pt-5">
                        <p onclick='handleRemoveItem(${
                            item.product_id
                        })' class="text-sm leading-3 hover:underline hover:underline-offset-4 text-red-500 pl-5 cursor-pointer">
                            Remove
                        </p>
                        <p class="text-base font-bold leading-none text-gray-800 dark:text-white">
                            €${item.product_price}
                        </p>
                    </div>
                </div>`;

            // add the container to the page, if it exists
            if (!!eTarget) {
                eTarget.innerHTML += htmlString;
            }
        });

        calculateCheckoutValues(products);
    });
}

$(document).ready(() => {
    handleButtonColor();
    renderCartItems();
});
