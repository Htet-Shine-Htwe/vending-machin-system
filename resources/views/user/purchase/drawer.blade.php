<div id="cart-drawer"
    class="fixed top-0 right-0 z-50 h-screen py-6 w-96 overflow-y-auto transition-transform translate-x-full bg-gray-100 dark:bg-gray-900 shadow-lg"
    tabindex="-1" aria-labelledby="drawer-right-label">
    <div class="flex items-center justify-between px-6">
        <h5 id="drawer-right-label" class="text-lg flex items-center font-semibold text-gray-800 dark:text-gray-200">
            <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            {{ __('Order Items') }}
        </h5>
        <button type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none"
            data-drawer-hide="cart-drawer">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <div class="mt-6 flex flex-col gap-8 px-6 h-[80vh] overflow-y-scroll">

    </div>

    <div class="h-28 bottom-0 fixed  bg-white shadow-sm w-96 px-6">
        <div class="flex flex-col justify-center gap-4 h-full ">

            <div class="flex justify-between items-center">
                <span class="text-lg font-bold text-gray-800 dark:text-gray-200">Total</span>


                <span class="text-lg font-bold text-gray-800 dark:text-gray-200">$
                    <span id="cart-total">0</span>
                </span>
            </div>

            <x-primary-button
            {{-- onclick="purchaseCartItems()" --}}
            id="checkout-btn"
            data-modal-target="crud-modal" data-modal-toggle="crud-modal"
            class="x-primary-button block !bg-green-500 disabled:!bg-green-200">
                Checkout
            </x-primary-button>
        </div>

    </div>

    @include('user.purchase.confirm-dialog')
</div>
