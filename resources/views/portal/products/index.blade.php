<x-app-layout>
    <x-slot name="header">
        {{ __('Products') }}


    </x-slot>

    <x-slot name="headerActions">

        <a href="{{ route('products.create') }}" class="btn flex justify-center items-center px-4 py-2 ml-4 text-sm font-semibold rounded-md
        bg-purple-600 text-white
        ">
            <svg class="w-4 h-4" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>

        </a>
    </x-slot>

    @php
        $sorts = [
            'price_desc' => 'Highest Price',
            'price_asc' => 'Lowest Price',
            'quantity_desc' => 'Highest Stock',
            'quantity_asc' => 'Lowest Stock',
        ];
    @endphp

        <section class="bg-white py-8 antialiased">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
              <!-- Heading & Filters -->
              <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
                <div>

                </div>
                <div class="flex items-center space-x-4">
                  <button id="sortDropdownButton1" data-dropdown-toggle="dropdownSort1" type="button" class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto">
                    <svg class="-ms-0.5 me-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M7 4l3 3M7 4 4 7m9-3h6l-6 6h6m-6.5 10 3.5-7 3.5 7M14 18h4" />
                    </svg>
                    Sort
                    <svg class="-me-0.5 ms-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                    </svg>
                  </button>
                  <div id="dropdownSort1" class="z-50 hidden w-40 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700" data-popper-placement="bottom">
                    <ul class="p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400" aria-labelledby="sortDropdownButton">

                        @foreach ($sorts as $key => $value)
                        <li>
                            <a href="{{ route('products.index', ['sort' => $key]) }}" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">
                                {{ $value }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                  </div>
                </div>
              </div>
              <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">

                @forelse ($products as $product)
                    <x-product-card :product="$product"/>
                @empty
                @endforelse

              </div>
              <div class="w-full text-center">
                <div class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                    {{ $products->links() }}
                </div>
              </div>
            </div>

          </section>


</x-app-layout>
