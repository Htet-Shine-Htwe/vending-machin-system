<x-app-layout>
    <x-slot name="header">
        {{ __($editPage ? "Edit Product" : "Add New Product") }}
    </x-slot>

    <x-slot name="headerActions">
        <a href="{{ route('products.index') }}"
            class="btn flex justify-center items-center px-4 py-2 ml-4 text-sm font-semibold rounded-md
        bg-gray-600 text-white
        ">
           {{-- go back svg --}}
           Cancel
        </a>
        <x-primary-button
        form="createProduct"
        class="block w-1/2 float-right">
            {{ __($editPage ? "Update" : "Save") }}
        </x-primary-button>

    </x-slot>

    <section class="bg-white py-8 antialiased rounded-sm shadow-md">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">

            <form method="POST" id="createProduct" action="{{ $editPage ? route('products.update',$product->slug) : route('products.store') }}">
                <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 ">

                    @csrf

                    <!-- Input[ype="email"] -->
                    <div class="mt-4">
                        <x-input-label :value="__('Name')" />
                        <x-text-input type="text" id="name" name="name"
                         value="{{ $editPage ? $product->name : old('name') }}"
                            class="block w-full" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="image" :value="__('Image Url')" />
                        <x-text-input type="text" id="image" name="image"
                        value="{{ $editPage ? $product->image : old('image') }}"
                        class="block w-full" />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <!-- Input[ype="password"] -->
                    <div class="mt-4">
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input type="text"
                        value="{{ $editPage ? $product->price : old('price') }}"
                        id="price" name="price" class="block w-full" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="quantity_available" :value="__('Instock')" />
                        <x-text-input type="number" id="quantity_available"
                        value="{{ $editPage ? $product->quantity_available : old('quantity_available') }}"
                        name="quantity_available" class="block w-full" />
                        <x-input-error :messages="$errors->get('quantity_available')" class="mt-2" />
                    </div>


                    <div class=""></div>
                    <div class="mt-4 w-full">

                    </div>

                </div>
            </form>

        </div>

    </section>

    @include('components.product-delete-modal')

</x-app-layout>
