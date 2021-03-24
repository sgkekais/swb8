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
        <!-- Favicons -->
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#000000">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        @livewireStyles

        <!-- Scripts -->
        <script src="https://kit.fontawesome.com/3e5662e9c8.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.js" defer></script>

    </head>
    <body class="font-mono antialiased">
    <div class="fixed top-0 right-0 m-8 p-3 z-50 text-xs font-mono text-white h-6 w-6 rounded-full flex items-center justify-center bg-gray-700 sm:bg-pink-500 md:bg-orange-500 lg:bg-green-500 xl:bg-blue-500">
        <div class="block  sm:hidden md:hidden lg:hidden xl:hidden">al</div>
        <div class="hidden sm:block  md:hidden lg:hidden xl:hidden">sm</div>
        <div class="hidden sm:hidden md:block  lg:hidden xl:hidden">md</div>
        <div class="hidden sm:hidden md:hidden lg:block  xl:hidden">lg</div>
        <div class="hidden sm:hidden md:hidden lg:hidden xl:block">xl</div>
    </div>
        <div class="min-h-screen bg-white">

            <!-- nav -->
            <div class="h-52 bg-center bg-cover border-b border-black" style="background-image: url({{ asset('img/bg-1.jpg') }}); ">
                <div class="absolute w-full pt-2 md:pt-8 h-52 flex items-center justify-center">
                    <x-jet-application-mark class="h-20 lg:h-24 w-auto fill-current text-white animate-pulse"/>
                </div>
                <div class="p-2 relative max-w-7xl mx-auto flex flex-col justify-between h-full">
                    @livewire('navigation-dropdown')
                    <div class="text-white">
                        Hobbyfußball seit {{ \Carbon\Carbon::make('25.11.1979')->diffForHumans(['syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE, 'parts' => 4, 'join' => ['n, ', ' und ']]) }}
                    </div>
                </div>
            </div>

            <!-- Page Heading -->
            @if (isset($header))
                <x-section class="py-4">
                    <header>
                        <x-headline class="text-3xl">
                            {{ $header }}
                        </x-headline>
                    </header>
                </x-section>
{{--                    <div class="-mt-16 sm:-mt-20 p-4 sm:p-6 max-w-7xl mx-auto bg-white border border-b-0 border-l-0 border-r-0 xl:border xl:border-b-0 border-black">--}}
{{--                        --}}
{{--                    </div>--}}
            @endif

            <!-- Page Content -->
            <main class="">
                {{ $slot }}
            </main>

            <!-- Page Footer -->
            <footer class="pt-12 bg-gray-900">
                <x-footer />
            </footer>

        </div>

        @stack('modals')

        @stack('scripts')

        @livewireScripts
    </body>
</html>
