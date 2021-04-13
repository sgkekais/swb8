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
    <body>
        <div class="font-mono antialiased">
            {{ $slot }}
        </div>

        @stack('modals')

        <!-- Scripts -->
        @livewireScripts
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://kit.fontawesome.com/3e5662e9c8.js" crossorigin="anonymous"></script>

        @stack('scripts')
    </body>
</html>
