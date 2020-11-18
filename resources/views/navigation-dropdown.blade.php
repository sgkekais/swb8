<nav x-data="{ open: false }" class="bg-gray-200 border-b border-gray-300">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        {{-- <x-jet-application-mark class="block h-9 w-auto" />--> --}}
                        <img class="h-12" src="{{ asset('img/swblogo50.png') }}">
                    </a>
                    <span class="font-uppercase font-bold tracking-tighter text-gray-700 text-lg">
                        {{ env('APP_NAME') }}
                    </span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ml-5 sm:flex">
                    @auth
                        <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-jet-nav-link>
                        @if(Auth::user()->isAdmin())
                            <x-jet-dropdown align="left">
                                <x-slot name="trigger">
                                    <x-jet-nav-link>
                                        Verwaltung
                                    </x-jet-nav-link>
                                </x-slot>
                                <x-slot name="content">
                                    <!-- Site Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Termine') }}
                                    </div>
                                    <x-jet-dropdown-link href="{{ route('admin.matches') }}" :active="request()->routeIs('admin.matches')">
                                        <i class="far fa-fw fa-calendar-alt"></i> Termine
                                    </x-jet-dropdown-link>
                                    <div class="border-t border-gray-200"></div>
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Verwaltung') }}
                                    </div>
                                    <x-jet-dropdown-link href="{{ route('admin.matches') }}" :active="request()->routeIs('admin.matches')">
                                        <i class="far fa-fw fa-handshake"></i> Paarungen - löschen!
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
                                </x-slot>

                            </x-jet-dropdown>

                        @endif
                    @endauth
                </div>
            </div>
            @auth
                @if (Auth::user()->isAdmin())
                    <div class="flex">
                        <x-jet-nav-link href="{{ route('admin.log') }}" :active="request()->routeIs('admin.log')">
                            Logbuch
                        </x-jet-nav-link>
                        <x-jet-nav-link>
                            Users
                        </x-jet-nav-link>
                    </div>
                @endif
            @endauth

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Account verwalten') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profil') }}
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



            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        @auth
            <div class="pt-2 pb-3 space-y-1">
                <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-jet-responsive-nav-link>
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
