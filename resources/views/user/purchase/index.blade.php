<x-app-layout>
    <x-slot name="header">
        {{ __('Products') }}


    </x-slot>

    <x-slot name="headerActions">


        <button type="button" data-drawer-target="cart-drawer" data-drawer-show="cart-drawer" data-drawer-placement="right"
            aria-controls="cart-drawer"
            class="relative inline-flex items-center p-3 text-sm font-medium text-center text-white bg-purple-700 rounded-lg ">
            @include('svgs.checkout')
            <span class="sr-only">Cart Count</span>
            <div id="cart-badge"
                class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">
                0</div>
        </button>
    </x-slot>

    @include('user.purchase.success-card')

    <div class="p-4 bg-white rounded-lg shadow-xs">


        <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Price</th>
                            <th class="px-4 py-3">Avaiable Stocks</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach ($products as $product)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-sm">
                                    {{ $product->name }}
                                </td>

                                <td class="px-4 py-3 text-sm">
                                    $ {{ $product->price }}
                                </td>

                                <td class="px-12 py-3 text-sm">
                                    @if ($product->quantity_available <= 0)
                                        <span class="text-red-500">Out of Stock</span>
                                    @else
                                        {{ $product->quantity_available }}
                                    @endif
                                </td>

                                <td class=" py-3 text-sm text-end">

                                    <x-primary-button onclick="handleCartItem({{ $product }},event)"
                                        :disabled="$product->quantity_available <= 0" data-product-id="{{ $product->id }}"
                                        data-product-quantity="{{ $product->quantity_available }}"
                                        class="x-primary-button block !bg-green-400
                                        disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-300
                                        ">
                                        @include('svgs.checkout', ['height' => '15', 'width' => '15'])
                                    </x-primary-button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div
                class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                {{ $products->links() }}
            </div>
        </div>

    </div>
    @include('user.purchase.drawer')
    @push('script')
        <script src="{{ asset('js/user/purchase.js') }}"></script>
        <script src="{{ asset('js/user/cart.js') }}"></script>
        <script src="{{ asset('js/user/cart-ui.js') }}"></script>
        <script>
            const server_products = @json($products)['data'];
            const cart = new Cart();
            const cartDrawer = document.querySelector('#cart-drawer .flex.flex-col');
            $("#purchase-error").hide();

            $("#close-sc").click(function() {
                $("#sc-backdrop").hide();
                $("#sc").fadeOut(600);
            });
            /**
             * Function to purchase the items in the cart.
             */
            function purchaseCartItems(e) {
                e.preventDefault();

                const formData = new FormData();
                const formElements = ['state', 'city', 'address', 'phone_number'];

                formElements.forEach(element => {
                    formData.append(element, e.target[element].value.trim());
                });

                cart.items.forEach((item, index) => {
                    formData.append(`products[${index}][id]`, item.id);
                    formData.append(`products[${index}][quantity]`, item.quantity);
                });

                const purchaseButton = $('#confirm-purchase');
                purchaseButton.prop('disabled', true);

                resetValidationErrors(formElements);
                const errorList = $("#purchase-error-list").html('');

                ajaxCallBack("{{ route('purchase.create') }}", formData, function(response) {

                    cart.clearCart();
                    $(".x-primary-button").removeClass('!bg-red-400').addClass('!bg-green-400');
                    cartDrawer.innerHTML = '';
                    $("#purchase-error").hide();

                    $("#sc-backdrop").show();
                     $("#sc").fadeIn(600);
                }, function(errors) {
                    console.log(errors)
                    handleAxiosFormError(errors);
                    // if not  422
                    if (errors.status !== 422) {
                        $("#purchase-error").show();
                        errorList.append(`<li>${errors.responseJSON.error}</li>`);
                    }
                }).always(function() {
                    purchaseButton.prop('disabled', false);
                });
            }



            /**
             * Updates the buttons on the page load based on the items in the cart.
             */
            function updateButtonsOnPageLoad() {
                document.querySelectorAll('.x-primary-button').forEach(button => {
                    const productId = button.getAttribute('data-product-id');

                    if (cart.isItemInCart(productId)) {
                        button.classList.remove('!bg-green-400');
                        button.classList.add('!bg-red-400');
                    }
                });
            }

            /**
             * Handles the cart item based on the product selected.
             *
             * @param {Object} product - The selected product.
             * @param {Event} e - The event object.
             */
            function handleCartItem(product, e) {
                const existingItem = cart.items.find(cartItem => cartItem.id === product.id);
                const server_product = server_products.find(server_product => server_product.id == product.id);

                if (existingItem) {
                    cart.removeItem(product.id);
                    removeItemFromCartUI(product.id);
                } else {
                    cart.addItem(new CartItem(product.id, product.name, product.price, 1));
                    const itemElement = appendItemToCartUI(product, cart, server_product);
                    cartDrawer.appendChild(itemElement);
                }
            }

            /**
             * Updates the state of a button based on whether a product is in the cart or not.
             *
             * @param {number} productId - The ID of the product.
             * @param {boolean} isInCart - Indicates whether the product is in the cart or not.
             */
            function updateButtonState(productId, isInCart) {
                const button = document.querySelector(`[data-product-id="${productId}"]`);

                if (isInCart) {
                    button.classList.remove('!bg-green-400');

                    button.classList.add('!bg-red-400');
                } else {
                    button.classList.remove('!bg-red-400');
                    button.classList.add('!bg-green-400');
                }
            }

            /**
             * Initializes the user interface for the cart.
             */
            function initializeCartUI(renderCart = true) {


                cart.items.forEach(item => {
                    updateButtonState(item.id, true);

                    if (renderCart) {
                        const server_product = server_products.find(server_product => server_product.id == item
                            .id);
                        const itemElement = appendItemToCartUI(item, cart, server_product);

                        cartDrawer.appendChild(itemElement);
                    }
                });
            }


            document.addEventListener('DOMContentLoaded', function() {

                initializeCartUI();

                updateCartBadge();

                /**
                 * Updates the cart badge with the total number of items in the cart.
                 */
                function updateCartBadge() {
                    const totalItems = cart.items.length;
                    document.getElementById('cart-badge').textContent = totalItems;
                }

                /**
                 * Display the total amount in the cart.
                 */
                cart.displayTotal();
            });
        </script>
    @endpush


</x-app-layout>
