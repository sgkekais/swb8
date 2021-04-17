<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Schwarz-Weiß Bilk \'79') }}</title>

        <!-- Search Engine -->
        <meta name="description" content="Hobbyfußball in Düsseldorf seit über 40 Jahren">
        <meta name="image" content="https://swbilk79.de/img/swblogo.png">
        <!-- Schema.org for Google -->
        <meta itemprop="name" content="Schwarz-Weiß Bilk '79">
        <meta itemprop="description" content="Hobbyfußball in Düsseldorf seit über 40 Jahren">
        <meta itemprop="image" content="https://swbilk79.de/img/swblogo.png">
        <!-- Twitter -->
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="Schwarz-Weiß Bilk '79">
        <meta name="twitter:description" content="Hobbyfußball in Düsseldorf seit über 40 Jahren">
        <!-- Open Graph general (Facebook, Pinterest & Google+) -->
        <meta name="og:title" content="Schwarz-Weiß Bilk '79">
        <meta name="og:description" content="Hobbyfußball in Düsseldorf seit über 40 Jahren">
        <meta name="og:image" content="https://swbilk79.de/img/swblogo.png">
        <meta name="og:url" content="https://swbilk79.de">
        <meta name="og:site_name" content="Schwarz-Weiß Bilk '79">
        <meta name="og:locale" content="de_DE">
        <meta name="fb:admins" content="175477382466028">
        <meta name="fb:app_id" content="175477382466028">
        <meta name="og:type" content="website">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @livewireStyles

        <!-- Favicons -->
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=jw3mgXqKeE">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?v=jw3mgXqKeE">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png?v=jw3mgXqKeE">
        <link rel="manifest" href="/site.webmanifest?v=jw3mgXqKeE">
        <link rel="mask-icon" href="/safari-pinned-tab.svg?v=jw3mgXqKeE" color="#5bbad5">
        <link rel="shortcut icon" href="/favicon.ico?v=jw3mgXqKeE">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="theme-color" content="#ffffff">

    </head>
    <body class="font-mono antialiased">
{{--    <div class="fixed top-0 right-0 m-8 p-3 z-50 text-xs font-mono text-white h-6 w-6 rounded-full flex items-center justify-center bg-gray-700 sm:bg-pink-500 md:bg-orange-500 lg:bg-green-500 xl:bg-blue-500">--}}
{{--        <div class="block  sm:hidden md:hidden lg:hidden xl:hidden">al</div>--}}
{{--        <div class="hidden sm:block  md:hidden lg:hidden xl:hidden">sm</div>--}}
{{--        <div class="hidden sm:hidden md:block  lg:hidden xl:hidden">md</div>--}}
{{--        <div class="hidden sm:hidden md:hidden lg:block  xl:hidden">lg</div>--}}
{{--        <div class="hidden sm:hidden md:hidden lg:hidden xl:block">xl</div>--}}
{{--    </div>--}}
        <div class="flex flex-col min-h-screen bg-white">

            <!-- nav -->
            <div class="h-48 bg-center bg-cover border-b border-black" style="background-image: url({{ asset('img/bg-1.jpg') }}); ">
{{--                <div class="absolute w-full pt-2 md:pt-8 h-52 flex items-center justify-center">--}}
{{--                    <x-jet-application-mark class="h-20 lg:h-24 w-auto fill-current text-white animate-pulse"/>--}}
{{--                </div>--}}
                <div class="p-2 relative max-w-7xl mx-auto flex flex-col justify-between h-full">
                    @livewire('navigation-dropdown')
                    <div class="text-white text-right">
                        @auth
                            Hi, {{ auth()->user()->name }}!
                        @endauth
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
            @endif

            <!-- Page Content -->
            <main class="flex-grow relative pb-8">

                <img src="/img/swblogo.png" alt="swblogobackground" class="absolute inset-x-0 mx-auto w-96 h-auto -bottom-24 opacity-5" />

                <div class="relative">
                    {{ $slot }}
                </div>

            </main>

            <!-- Page Footer -->
            <footer class="relative pt-8 bg-gray-700">
                <x-footer />
            </footer>

        </div>

        @stack('modals')

        <!-- Scripts -->
        @livewireScripts
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://kit.fontawesome.com/3e5662e9c8.js" crossorigin="anonymous"></script>

        @stack('scripts')

    </body>
</html>
