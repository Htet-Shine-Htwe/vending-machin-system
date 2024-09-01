<?php
use App\Enums\RoleEnum;
?>

<aside class="z-20 hidden w-64 overflow-y-auto bg-white md:block flex-shrink-0">
    <div class="py-4 text-gray-500">
        <a class="ml-6 text-lg font-bold text-gray-800" href="{{ route('dashboard') }}">
            VMW
        </a>

        <ul class="mt-6">

            @role(enum_value(RoleEnum::USER).'|'.enum_value(RoleEnum::ADMIN))
            <li class="relative px-6 py-3">
                <x-nav-link href="{{ route('purchase.index') }}" :active="request()->routeIs('purchase.index')">
                    <x-slot name="icon">
                    <svg fill="none" height="15" viewBox="0 0 15 15" width="15" xmlns="http://www.w3.org/2000/svg"><path d="M0.978822 0.356323L0.0209961 0.643671L3.12789 11H14.9999V4.5C14.9999 3.11929 13.8806 2 12.4999 2H1.47192L0.978822 0.356323Z" fill="black"/><path clip-rule="evenodd" d="M5.5 12C4.67157 12 4 12.6716 4 13.5C4 14.3284 4.67157 15 5.5 15C6.32843 15 7 14.3284 7 13.5C7 12.6716 6.32843 12 5.5 12ZM5 13.5C5 13.2239 5.22386 13 5.5 13C5.77614 13 6 13.2239 6 13.5C6 13.7761 5.77614 14 5.5 14C5.22386 14 5 13.7761 5 13.5Z" fill="black" fill-rule="evenodd"/><path clip-rule="evenodd" d="M12.5 12C11.6716 12 11 12.6716 11 13.5C11 14.3284 11.6716 15 12.5 15C13.3284 15 14 14.3284 14 13.5C14 12.6716 13.3284 12 12.5 12ZM12 13.5C12 13.2239 12.2239 13 12.5 13C12.7761 13 13 13.2239 13 13.5C13 13.7761 12.7761 14 12.5 14C12.2239 14 12 13.7761 12 13.5Z" fill="black" fill-rule="evenodd"/></svg>
                    </x-slot>
                    {{ __('Purchase') }}
                </x-nav-link>
            </li>
            @endrole

            @role(enum_value(RoleEnum::ADMIN))
            <li class="relative px-6 py-3">
                <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.index')">
                    <x-slot name="icon">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </x-slot>
                    {{ __('Users') }}
                </x-nav-link>
            </li>
            @endrole

            @role(enum_value(RoleEnum::ADMIN))
            <li class="relative px-6 py-3">
                <x-nav-link href="{{ route('products.index') }}" :active="request()->routeIs('products.index')">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                            <path d="M4.5 10.2653V6H19.5V10.2653C19.5 13.4401 19.5 15.0275 18.5237 16.0137C17.5474 17 15.976 17 12.8333 17H11.1667C8.02397 17 6.45262 17 5.47631 16.0137C4.5 15.0275 4.5 13.4401 4.5 10.2653Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4.5 6L5.22115 4.46154C5.78045 3.26838 6.06009 2.6718 6.62692 2.3359C7.19375 2 7.92084 2 9.375 2H14.625C16.0792 2 16.8062 2 17.3731 2.3359C17.9399 2.6718 18.2196 3.26838 18.7788 4.46154L19.5 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M10.5 9H13.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M12 19.5V22M12 19.5L7 19.5M12 19.5H17M7 19.5H4.5C3.11929 19.5 2 20.6193 2 22M7 19.5V22M17 19.5H19.5C20.8807 19.5 22 20.6193 22 22M17 19.5V22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </x-slot>
                    {{ __('Products') }}
                </x-nav-link>
            </li>
            @endrole


            <li class="relative px-6 py-3">
                <x-nav-link href="{{ route('transactions.index') }}" :active="request()->routeIs('transactions.index')">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" color="#000000" fill="none">
                            <path d="M20.5 16.9286V10C20.5 6.22876 20.5 4.34315 19.3284 3.17157C18.1569 2 16.2712 2 12.5 2H11.5C7.72876 2 5.84315 2 4.67157 3.17157C3.5 4.34315 3.5 6.22876 3.5 10V19.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M20.5 17H6C4.61929 17 3.5 18.1193 3.5 19.5C3.5 20.8807 4.61929 22 6 22H20.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M20.5 22C19.1193 22 18 20.8807 18 19.5C18 18.1193 19.1193 17 20.5 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M15 7L9 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 11L9 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </x-slot>
                    {{ __('Transactions') }}
                </x-nav-link>
            </li>



            {{-- <li class="relative px-6 py-3">
                <button class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                        @click="toggleMultiLevelMenu" aria-haspopup="true">
                <span class="inline-flex items-center">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    <span class="ml-4">Two-level menu</span>
                </span>
                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                </button>
                <template x-if="isMultiLevelMenuOpen">
                    <ul x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <a class="w-full" href="#">Child menu</a>
                        </li>
                    </ul>
                </template>
            </li> --}}
        </ul>
    </div>
</aside>
