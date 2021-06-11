<nav x-data="{ open: false }" class="">
    <!-- Primary Navigation Menu -->
    <div class="flex justify-between h-12">
        <!-- Navigation Links -->
        <div class="hidden md:space-x-2 lg:space-x-4 md:flex md:flex-1 md:items-stretch">
            <x-jet-nav-link href="{{ route('calendar').'#'.(\Carbon\Carbon::now()->translatedFormat('F')) }}" :active="request()->routeIs('calendar')" class="">
                Kalender
            </x-jet-nav-link>
            @foreach(\App\Models\Club::owner(true)->orderByDesc('name_code')->get() as $nav_club)
                <x-jet-dropdown align="left">
                    <x-slot name="trigger">
                        <x-jet-nav-link class="cursor-pointer" :active="request()->segment(2) == $nav_club->id">
                            {{ __($nav_club->name_code) }} <i class="inline-block ml-1 fas fa-sort-down"></i>
                        </x-jet-nav-link>
                    </x-slot>
                    <x-slot name="content">
                        <x-jet-dropdown-link href="{{ route('club.schedule', $nav_club) }}" :active="request()->segment(2) == $nav_club->id && request()->segment(3) === 'spielplan'">
                            <i class="far fa-fw fa-calendar-alt"></i> Spielplan
                        </x-jet-dropdown-link>
                        <x-jet-dropdown-link href="{{ route('club.scorers', $nav_club) }}" :active="request()->segment(2) == $nav_club->id && request()->segment(3) === 'scorer'">
                            <i class="far fa-fw fa-futbol"></i> Tore & Assists
                        </x-jet-dropdown-link>
                        <x-jet-dropdown-link href="{{ route('club.sinners', $nav_club) }}" :active="request()->segment(2) == $nav_club->id && request()->segment(3) === 'suender'">
                            <i class="far fa-fw fa-copy"></i> Karten
                        </x-jet-dropdown-link>
                        <x-jet-dropdown-link href="{{ route('club.squad', $nav_club) }}" :active="request()->segment(2) == $nav_club->id && request()->segment(3) === 'kader'">
                            <i class="fas fa-fw fa-users"></i> Kader
                        </x-jet-dropdown-link>
                    </x-slot>
                </x-jet-dropdown>
            @endforeach
            <x-jet-dropdown align="left">
                <x-slot name="trigger">
                    <x-jet-nav-link class="cursor-pointer">
                        Verein <i class="inline-block ml-1 fas fa-sort-down"></i>
                    </x-jet-nav-link>
                </x-slot>
                <x-slot name="content">
                    <x-jet-dropdown-link href="{{ route('about') }}" :active="request()->routeIs('about')" class="">
                        <i class="fas fa-fw fa-info-circle"></i> Über uns
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="{{ route('historic-scorers') }}" :active="request()->routeIs('historic-scorers')" class="">
                        <i class="fas fa-fw fa-book"></i> Ewige Scorer
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="{{ route('historic-ananas-farmers') }}" :active="request()->routeIs('historic-ananas-farmers')" class="">
                        <i class="fas fa-fw fa-book"></i> Ewige Ananas
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="{{ route('hall-of-fame') }}" :active="request()->routeIs('hall-of-fame')" class="">
                        <i class="fas fa-fw fa-crown"></i> Ruhmeshalle
                    </x-jet-dropdown-link>
                </x-slot>
            </x-jet-dropdown>
        </div>
        <!-- Logo -->
        <a class="flex flex-1 justify-start md:justify-center" href="{{ route('home') }}" title="zur Startseite">
            <x-jet-application-mark class="h-20 md:h-28 w-auto fill-current text-white hover:text-black "/>
        </a>
        <!-- Profile-related Links -->
        <div class="hidden md:flex md:flex-1 md:justify-end md:items-center md:items-stretch md:ml-6 md:space-x-2 lg:space-x-4">
            @auth
                <!-- Settings Dropdown -->
                <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    Dein Verein
                </x-jet-nav-link>
                {{-- if admin --}}
                @if(Auth::user()->isAdmin())
                    <x-jet-dropdown align="right">
                        <x-slot name="trigger">
                            <x-jet-nav-link :active="request()->routeIs('admin.*')" class="cursor-pointer">
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
                            <x-jet-dropdown-link href="{{ route('admin.scorer-kings') }}" :active="request()->routeIs('admin.scorer-kings')">
                                <i class="fas fa-fw fa-crown"></i> Scorer-Könige
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ route('admin.ananas-kings') }}" :active="request()->routeIs('admin.ananas-kings')">
                                &#127821; Ananas-Könige
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
                            <x-jet-dropdown-link href="{{ route('admin.users') }}" :active="request()->routeIs('admin.users')">
                                <i class="fas fa-fw fa-user"></i> User
                            </x-jet-dropdown-link>
                        </x-slot>
                    </x-jet-dropdown>
                @endif
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                    <img class="h-12 w-12 rounded-full object-cover ring ring-white hover:opacity-90" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" title="Profil-Einstellungen"/>
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-primary-700">
                                Account-Verwaltung
                            </div>
                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                <i class="fas fa-cog"></i> Einstellungen
                            </x-jet-dropdown-link>

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Abmelden
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            @endauth
            @guest
                <div class="space-x-8 md:-my-px md:ml-10 md:flex md:items-stretch">
                    <x-jet-nav-link href="{{ route('login') }}" class="">
                        Anmelden
                    </x-jet-nav-link>
                </div>
            @endguest
        </div>
        <!-- Hamberder -->
        <div class="flex items-center md:hidden">
            <x-button @click="open = ! open">
                <svg class="h-4 w-4" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </x-button>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="absolute inset-x-0 hidden md:hidden min-h-screen w-full z-50 bg-white text-lg">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                <!-- Responsive Settings Options -->
                <div class="pb-1 border-b-2 border-gray-300">
                    <div class="flex items-center px-4">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="flex-shrink-0 mr-3">
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </div>
                        @endif
                        <div>
                            <div class="font-medium text-base text-gray-800">Hi, {{ Auth::user()->name }}!</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                    <div class="mt-3 space-y-1">
                        <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                            <i class="fas fa-heartbeat"></i> Dein Verein
                        </x-jet-responsive-nav-link>
                        <!-- Account Management -->
                        <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                            <i class="fas fa-cog"></i> Einstellungen
                        </x-jet-responsive-nav-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                                       onclick="event.preventDefault();
                                this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Abmelden
                            </x-jet-responsive-nav-link>
                        </form>
                    </div>
                </div>
            @endauth
            @guest
                <div class="border-b border-gray-900">
                    <x-jet-responsive-nav-link href="{{ route('login') }}" class="">
                        <i class="fas fa-sign-in-alt"></i> Anmelden
                    </x-jet-responsive-nav-link>
                </div>
            @endguest
            <!-- Responsive Menu -->
            <x-jet-responsive-nav-link href="{{ route('calendar', ['monat' => \Carbon\Carbon::now()->translatedFormat('F')]) }}" :active="request()->routeIs('calendar')" class="">
                <i class="far fa-calendar-alt"></i> Kalender
            </x-jet-responsive-nav-link>
            @foreach(\App\Models\Club::owner(true)->orderByDesc('name_code')->get() as $nav_club)
                <div x-data="{ show: false }" class="">
                    <x-jet-responsive-nav-link @click="show=!show" class="cursor-pointer">
                        <i class="far fa-futbol"></i> {{ __($nav_club->name_code) }}
                        <svg :class="{'rotate-180': show}"
                             xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 24 24"
                             class="transform inline-block fill-current w-6 h-6 animate-pulse font-bold">
                            <path fill-rule="evenodd" d="M15.3 10.3a1 1 0 011.4 1.4l-4 4a1 1 0 01-1.4 0l-4-4a1 1 0 011.4-1.4l3.3 3.29 3.3-3.3z"/>
                        </svg>
                    </x-jet-responsive-nav-link>
                    <div x-show.transition="show" class="m-3 border-l-4">
                        <x-jet-responsive-nav-link class="ml-3" href="{{ route('club.schedule', $nav_club) }}" :active="request()->segment(2) == $nav_club->id && request()->segment(3) === 'spielplan'">
                            <i class="far fa-fw fa-calendar-alt"></i> Spielplan
                        </x-jet-responsive-nav-link>
                        <x-jet-responsive-nav-link class="ml-3" href="{{ route('club.scorers', $nav_club) }}" :active="request()->segment(2) == $nav_club->id && request()->segment(3) === 'scorer'">
                            <i class="far fa-fw fa-futbol"></i> Tore & Assists
                        </x-jet-responsive-nav-link>
                        <x-jet-responsive-nav-link class="ml-3" href="{{ route('club.sinners', $nav_club) }}" :active="request()->segment(2) == $nav_club->id && request()->segment(3) === 'suender'">
                            <i class="far fa-fw fa-copy"></i> Karten
                        </x-jet-responsive-nav-link>
                        <x-jet-responsive-nav-link class="ml-3" href="{{ route('club.squad', $nav_club) }}" :active="request()->segment(2) == $nav_club->id && request()->segment(3) === 'kader'">
                            <i class="fas fa-fw fa-users"></i> Kader
                        </x-jet-responsive-nav-link>
                    </div>
                </div>
            @endforeach
            <div x-data="{ show: false }" class="">
                <x-jet-responsive-nav-link @click="show=!show" class="cursor-pointer">
                    <i class="fas fa-shield-alt"></i> Verein
                    <svg :class="{'rotate-180': show}"
                         xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24"
                         class="transform inline-block fill-current w-6 h-6 animate-pulse font-bold">
                        <path fill-rule="evenodd" d="M15.3 10.3a1 1 0 011.4 1.4l-4 4a1 1 0 01-1.4 0l-4-4a1 1 0 011.4-1.4l3.3 3.29 3.3-3.3z"/>
                    </svg>
                </x-jet-responsive-nav-link>
                <div x-show.transition="show" class="m-3 border-l-4">
                    <x-jet-responsive-nav-link class="ml-3" href="{{ route('about') }}" :active="request()->routeIs('about')">
                        <i class="fas fa-fw fa-info-circle"></i> Über uns
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link class="ml-3" href="{{ route('historic-scorers') }}" :active="request()->routeIs('historic-scorers')" >
                        <i class="fas fa-fw fa-book"></i> Ewige Scorer
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link class="ml-3" href="{{ route('historic-ananas-farmers') }}" :active="request()->routeIs('historic-ananas-farmers')" >
                        <i class="fas fa-fw fa-book"></i> Ewige Ananas
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link class="ml-3" href="{{ route('hall-of-fame') }}" :active="request()->routeIs('hall-of-fame')" >
                        <i class="fas fa-fw fa-crown"></i> Ruhmeshalle
                    </x-jet-responsive-nav-link>
                </div>
            </div>
        </div>
    </div>
</nav>
