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
                                    {{ $product->quantity_available }}
                                </td>

                                <td class=" py-3 text-sm text-end">

                                    <x-primary-button onclick="handleCartItem({{ $product }},event)"
                                        data-product-id="{{ $product->id }}"
                                        class="x-primary-button block !bg-green-400">
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
        {{-- <script src="{{ asset('js/user/purchase.js') }}"></script> --}}
        <script src="{{ asset('js/user/cart.js') }}"></script>
        <script src="{{ asset('js/user/cart-ui.js') }}"></script>
        <script >

            const cart = new Cart();
            const cartDrawer = document.querySelector('#cart-drawer .flex.flex-col');

            function updateButtonsOnPageLoad() {
                document.querySelectorAll('.x-primary-button').forEach(button => {
                    const productId = button.getAttribute('data-product-id');

                    if (cart.isItemInCart(productId)) {
                        button.classList.remove('!bg-green-400');
                        button.classList.add('!bg-red-400');
                    }
                });
            }

            function handleCartItem(product, e) {
                const existingItem = cart.items.find(cartItem => cartItem.id === product.id);

                if (existingItem) {
                    cart.removeItem(product.id);
                    removeItemFromCartUI(product.id);
                } else {
                    cart.addItem(new CartItem(product.id, product.name, product.price, 1));
                    const itemElement = appendItemToCartUI(product,cart);
                    cartDrawer.appendChild(itemElement);
                }

            }

            function updateButtonState(productId, isInCart) {
                const button = document.querySelector(`[data-product-id="${productId}"]`);
                console.log(button);
                if (isInCart) {
                    button.classList.remove('!bg-green-400');
                    button.classList.add('!bg-red-400');
                } else {
                    button.classList.remove('!bg-red-400');
                    button.classList.add('!bg-green-400');
                }
            }

            document.addEventListener('DOMContentLoaded', function() {

                initializeCartUI();

                updateCartBadge();

                function updateCartBadge() {
                    // length of items in cart
                    const totalItems = cart.items.length;
                    document.getElementById('cart-badge').textContent = totalItems;
                }

                function initializeCartUI() {
                    cart.items.forEach(item => {
                        console.log(item);
                        updateButtonState(item.id, true);
                        appendItemToCartUI(item);
                        const itemElement = appendItemToCartUI(item,cart);

                        cartDrawer.appendChild(itemElement);
                    });
                }

                cart.displayTotal();
            });
        </script>
    @endpush


</x-app-layout>
