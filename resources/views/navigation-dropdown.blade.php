<nav x-data="{ open: false }" class="">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto {{-- px-2 sm:px-6 lg:px-8>--}}">
        <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-expanded="false">
                    <svg :class="{'hidden': open, 'block': ! open }" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg :class="{'block': open, 'hidden': ! open }" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Logo -->
            <div class="flex flex-grow justify-center sm:flex-grow-0 sm:pr-0 sm:justify-start">
                {{--<a href="{{ route('home') }}">
                    <x-jet-application-mark class="block h-9 w-auto" />
                     <img class="h-12" src="{{ asset('img/swblogo50inv.png') }}">
                </a>
                <span class="uppercase font-bold tracking-tighter text-gray-700 text-lg">
                    <a href="{{ route('home') }}">{{ env('APP_NAME') }}</a>
                </span>--}}
                <a href="{{ route('home') }}" class="bg-white block md:p-4">
                    <x-jet-application-mark class="block h-12 md:h-24 w-auto md:mt-12" title="{{ env('APP_NAME') }}"/>
                </a>
            </div>
            <!-- END Logo -->
            <!-- Navigation Links -->
            <div class="hidden sm:block flex flex-grow items-center sm:items-stretch sm:justify-center">
                <div class="hidden sm:block">
                    <div class="flex space-x-4 justify-between">
                        <div class="flex space-x-2 pl-4">
                            <x-jet-nav-link href="{{ route('calendar', ['monat' => \Carbon\Carbon::now()->translatedFormat('F')]) }}" :active="request()->routeIs('calendar')" class="py-3">
                                Kalender
                            </x-jet-nav-link>
                            @foreach(\App\Models\Club::owner(true)->orderByDesc('name_code')->get() as $nav_club)
                                <x-jet-dropdown align="left">
                                    <x-slot name="trigger">
                                        <x-jet-nav-link class="py-3 cursor-pointer" :active="request()->segment(2) == $nav_club->id">
                                            {{ __($nav_club->name_code) }} <i class="inline-block ml-1 fas fa-sort-down"></i>
                                        </x-jet-nav-link>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-jet-dropdown-link href="{{ route('club.schedule', $nav_club) }}" :active="request()->segment(2) == $nav_club->id && request()->segment(3) === 'spielplan'">
                                            <i class="far fa-fw fa-calendar-alt"></i> Spielplan
                                        </x-jet-dropdown-link>
                                        <x-jet-dropdown-link href="{{ route('club.scorers', $nav_club) }}" :active="request()->segment(2) == $nav_club->id && request()->segment(3) === 'scorers'">
                                            <i class="far fa-fw fa-futbol"></i> Tore & Assists
                                        </x-jet-dropdown-link>
                                        <x-jet-dropdown-link>
                                            <i class="far fa-fw fa-copy"></i> Karten
                                        </x-jet-dropdown-link>
                                        <x-jet-dropdown-link>
                                            <i class="fas fa-fw fa-users"></i> Kader
                                        </x-jet-dropdown-link>

                                    </x-slot>
                                </x-jet-dropdown>
                            @endforeach
                            <x-jet-dropdown align="left">
                                <x-slot name="trigger">
                                    <x-jet-nav-link class="py-3 cursor-pointer">
                                        Verein <i class="inline-block ml-1 fas fa-sort-down"></i>
                                    </x-jet-nav-link>
                                </x-slot>
                                <x-slot name="content">
                                    <x-jet-dropdown-link>
                                        <i class="fas fa-fw fa-info-circle"></i> Über uns
                                    </x-jet-dropdown-link>
                                    <x-jet-dropdown-link>
                                        <i class="fas fa-fw fa-book"></i> Ewigenlisten
                                    </x-jet-dropdown-link>
                                </x-slot>
                            </x-jet-dropdown>
                        </div>

                        @auth
                            <div class="flex space-x-2">
                                <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="py-3">
                                    Mein Verein
                                </x-jet-nav-link>
                                @if(Auth::user()->isAdmin())
                                    <x-jet-dropdown align="left">
                                        <x-slot name="trigger">
                                            <x-jet-nav-link :active="request()->routeIs('admin.*')" class="py-3 cursor-pointer">
                                                Verwaltung <i class="inline-block ml-1 fas fa-sort-down"></i>
                                            </x-jet-nav-link>
                                        </x-slot>
                                        <x-slot name="content">
                                            <!-- Site Management -->
                                            <div class="block px-4 py-2 text-xs text-primary-700">
                                                Umfragen & Spiele
                                            </div>
                                            <x-jet-dropdown-link href="{{ route('admin.dates') }}" :active="request()->routeIs('admin.dates')">
                                                <i class="far fa-fw fa-calendar-alt"></i> Termine
                                            </x-jet-dropdown-link>
                                            <x-jet-dropdown-link href="{{ route('admin.matches') }}" :active="request()->routeIs('admin.matches')">
                                                <i class="fas fa-fw fa-stopwatch"></i> Spiele
                                            </x-jet-dropdown-link>
                                            <x-jet-dropdown-link href="{{ route('admin.cards') }}" :active="request()->routeIs('admin.cards')">
                                                <i class="far fa-fw fa-copy"></i> Karten
                                            </x-jet-dropdown-link>
                                            <x-jet-dropdown-link href="{{ route('admin.goals') }}" :active="request()->routeIs('admin.goals')">
                                                <i class="far fa-fw fa-futbol"></i> Tore
                                            </x-jet-dropdown-link>
                                            <x-jet-dropdown-link href="{{ route('admin.assists') }}" :active="request()->routeIs('admin.assists')">
                                                <i class="far fa-fw fa-handshake"></i> Vorlagen
                                            </x-jet-dropdown-link>
                                            <x-jet-dropdown-link href="{{ route('admin.tournaments') }}" :active="request()->routeIs('admin.tournaments')">
                                                <i class="fas fa-fw fa-hotdog"></i> Turniere
                                            </x-jet-dropdown-link>
                                            <x-jet-dropdown-link href="{{ route('admin.seasons') }}" :active="request()->routeIs('admin.seasons')">
                                                <i class="fas fa-fw fa-sync"></i> Saisons
                                            </x-jet-dropdown-link>
                                            <div class="border-t border-gray-300"></div>
                                            <div class="block px-4 py-2 text-xs text-primary-700">
                                                Verwaltung
                                            </div>
                                            <x-jet-dropdown-link href="{{ route('admin.player-statuses') }}" :active="request()->routeIs('admin.player-statuses')">
                                                <i class="fas fa-fw fa-user-tag"></i> Spieler-Status
                                            </x-jet-dropdown-link>
                                            <x-jet-dropdown-link href="{{ route('admin.players') }}" :active="request()->routeIs('admin.players')">
                                                <i class="fas fa-fw fa-user-friends"></i> Spieler
                                            </x-jet-dropdown-link>
                                            <x-jet-dropdown-link href="{{ route('admin.clubs') }}" :active="request()->routeIs('admin.clubs')">
                                                <i class="fas fa-fw fa-shield-alt"></i> Mannschaften
                                            </x-jet-dropdown-link>
                                            <x-jet-dropdown-link href="{{ route('admin.locations') }}" :active="request()->routeIs('admin.locations')">
                                                <i class="fas fa-fw fa-map-marked-alt"></i> Standorte
                                            </x-jet-dropdown-link>
                                            <x-jet-dropdown-link href="{{ route('admin.match-types') }}" :active="request()->routeIs('admin.match-types')">
                                                <i class="fas fa-fw fa-handshake"></i> Spielarten
                                            </x-jet-dropdown-link>
                                            <x-jet-dropdown-link href="{{ route('admin.date-types') }}" :active="request()->routeIs('admin.date-types')">
                                                <i class="fas fa-fw fa-calendar-alt"></i> Terminarten
                                            </x-jet-dropdown-link>
                                            <x-jet-dropdown-link href="{{ route('admin.log') }}" :active="request()->routeIs('admin.log')">
                                                <i class="fas fa-fw fa-history"></i> Logbuch
                                            </x-jet-dropdown-link>
                                            <x-jet-dropdown-link href="#">
                                                <i class="fas fa-fw fa-user"></i> Users
                                            </x-jet-dropdown-link>
                                        </x-slot>

                                    </x-jet-dropdown>

                                @endif
                            </div>

                        @endauth
                    </div>
                </div>
            </div>
            <!-- END Navigation Links -->
            <!-- Settings Dropdown -->
            <div class="flex justify-end items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                @auth
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                <img class="h-12 w-12 ring-2 ring-white rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Hi, {{ auth()->user()->name }}!
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                Einstellungen
                            </x-jet-dropdown-link>

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                    {{ __('Logout') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="inline-flex items-center text-sm font-bold leading-5 uppercase text-gray-400 hover:text-gray-200 focus:outline-none focus:text-gray-200 transition duration-150 ease-in-out">
                        Login
                    </a>
                @endguest
            </div>
            <!-- END Settings Dropdown -->
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        @auth
            <div class="pt-2 pb-3 space-y-1">
                <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-jet-responsive-nav-link>
                Verwaltung Aufklappbar
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>

                    <div class="ml-3">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Profile') }}
                    </x-jet-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                            {{ __('Logout') }}
                        </x-jet-responsive-nav-link>
                    </form>

                </div>
            </div>
        @endauth
    </div>
</nav>
