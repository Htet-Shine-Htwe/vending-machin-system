function appendItemToCartUI(product, cart) {
    const itemElement = document.createElement('div');
    itemElement.className =
        'flex justify-between items-center p-4 bg-gray-50 dark:bg-gray-800 rounded-lg shadow-sm';
    itemElement.setAttribute('data-cart-product-id', product.id);
    itemElement.innerHTML = `
            <div class="flex flex-col">
            <h6 class="text-md font-medium text-gray-900 dark:text-gray-100">${product.name}</h6>
            <span class="text-lg font-semibold text-gray-800 dark:text-gray-200">$${product.price}</span>
            </div>
            <div class="text-right">
            <div class="mt-2 flex items-center space-x-3">
                <button type="button" class="decrement-button flex h-6 w-6 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                    <svg class="h-3 w-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                    </svg>
                </button>
                <input type="text"
                style="width: 2.6rem!important;"
                 class="counter-input  border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" value="${product.quantity ?? 1}" readonly/>
                <button type="button" class="increment-button flex h-6 w-6 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                <svg class="h-3 w-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                </button>
            </div>
            </div>
    `;

    function updateCartItemUI(productId) {
        const itemElement = document.querySelector(`[data-cart-product-id="${productId}"]`);
        if (itemElement) {
            const item = cart.items.find(cartItem => cartItem.id === productId);
            if (item) {
                const counterInput = itemElement.querySelector('.counter-input');
                console.log(itemElement)
                if (counterInput) {
                    counterInput.value = item.quantity;
                } else {
                    console.error('Counter input element not found');
                }
            } else {
                itemElement.remove(); // Remove item from UI if it no longer exists in the cart
            }
        } else {
            console.error('Item element not found');
        }
    }

    itemElement.querySelector('.increment-button').addEventListener('click', function () {
        cart.increaseQuantity(product.id);
        updateCartItemUI(product.id);
    });

    itemElement.querySelector('.decrement-button').addEventListener('click', function () {
        cart.decreaseQuantity(product.id);
        updateCartItemUI(product.id);
    });

    return itemElement;
}

function removeItemFromCartUI(productId) {
    const itemElement = document.querySelector(`[data-cart-product-id="${productId}"]`);
    if (itemElement) {
        itemElement.remove();
    } else {
        console.error('Item element to remove not found');
    }
}
