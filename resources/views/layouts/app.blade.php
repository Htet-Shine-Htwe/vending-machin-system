<!DOCTYPE html>
<html x-data="data" lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Scripts -->
        <script src="{{ asset('js/init-alpine.js') }}"></script>
</head>
<body>
<div
    class="flex max-h-screen bg-gray-50"
    :class="{ 'overflow-hidden': isSideMenuOpen }"
>
    @include('layouts.navigation')

    @include('layouts.navigation-mobile')



    <div class="flex flex-col flex-1 w-full">

        @include('layouts.top-menu')

        @if (session('error'))
            <div class="alert alert-danger">
                <div class="p-4 mb-4 text-sm text-red-800 bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <span class="font-medium">Failed !</span> {{ session('error') }}
                  </div>
            </div>
        @endif

        @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-600 bg-green-200 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">Success !</span> {{ session('success') }}
          </div>
        @endif

        <main class=" overflow-y-auto h-screen">
            <div class="container px-6 mx-auto grid ">

                <div class="flex items-center justify-between">
                    @if (isset($header))
                    <h2 class="my-6 text-2xl font-semibold text-gray-700">
                        {{ $header }}
                    </h2>
                    @endif

                    @if (isset($headerActions))
                        <div class="flex gap-3">
                            {{ $headerActions }}
                        </div>
                    @endif
                </div>

                {{ $slot }}
            </div>
        </main>
    </div>
</div>

@stack('script')
</body>
</html>
