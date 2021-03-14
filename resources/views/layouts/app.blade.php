<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&display=swap" rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="https://kit.fontawesome.com/3e5662e9c8.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.js" defer></script>

    </head>
    <body class="font-mono antialiased">
        <div class="min-h-screen bg-white">

            <div class="h-64" style="background-image: url({{ asset('img/bg-1.jpg') }}); background-position: center; background-size: cover">
                @livewire('navigation-dropdown')
            </div>

            <!-- Page Heading -->
            <header class="">
                <div class="-mt-16 sm:-mt-20 p-4 sm:p-6 max-w-7xl mx-auto bg-white border border-b-0 border-l-0 border-r-0 xl:border xl:border-b-0 border-black">
                    <h1 class="font-sans font-extrabold text-3xl tracking-tighter">
                        {{ $header }}
                    </h1>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <div class="min-h-screen">
                    <div class="max-w-7xl mx-auto p-4 sm:px-6">
                        {{ $slot }}
                    </div>
                </div>
            </main>

            <!-- Page Footer -->
            <footer>
                <div class="bg-gray-700">
                    <div class="max-w-7xl mx-auto p-4 sm:px-6">

                    </div>
                </div>
            </footer>
        </div>

        @stack('modals')

        @stack('scripts')

        @livewireScripts
    </body>
</html>
