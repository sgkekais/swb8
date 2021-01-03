<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap"> --}}
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
                <div class="-mt-20 bg-white max-w-7xl mx-auto p-6 ">
                    <h1 class="font-sans font-extrabold text-2xl tracking-tighter">
                        {{ $header }}
                    </h1>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @stack('scripts')

        @livewireScripts
    </body>
</html>
