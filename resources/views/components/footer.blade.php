<div class="px-4 xl:px-0 max-w-7xl mx-auto text-white">
    <div class="grid gap-16 row-gap-10 mb-8 lg:grid-cols-6">
        <div class="md:max-w-md lg:col-span-2">
            <a href="{{ route('home') }}" aria-label="Startseite" title="SW Bilk '79 - Startseite" class="inline-flex items-center">
                <x-jet-application-mark class="fill-current text-white w-32 h-auto" />
                <span class="ml-4 font-sans font-bold text-3xl tracking-tighter text-gray-100 uppercase">Schwarz-Weiß Bilk '79</span>
            </a>
            <div class="mt-4 lg:max-w-sm">
                <p class="text-sm text-gray-100">
                    Hobbyfußball seit {{ \Carbon\Carbon::make('25.11.1979')->diffForHumans(['syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE, 'parts' => 4, 'join' => ['n, ', ' und ']]) }}.
                </p>
{{--                <p class="mt-4 text-sm text-gray-100">--}}
{{--                    Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.--}}
{{--                </p>--}}
            </div>
        </div>
        <div class="grid grid-cols-2 gap-5 row-gap-8 lg:col-span-4 md:grid-cols-4">
            <div class="flex flex-col space-y-4">
                <div>
                    <p class="font-semibold tracking-wide text-gray-100">Verein</p>
                    <ul class="mt-2 space-y-2">
                        <li>
                            <a href="{{ route('calendar') }}" class="text-gray-300" title="Kalender">Kalender</a>
                        </li>
                        <li>
                            <a href="{{ route('about') }}" class="text-gray-300" title="Über uns">Über uns</a>
                        </li>
                        <li>
                            <a href="{{ route('historic-scorers') }}" class="text-gray-300" title="Ewige Scorer">Ewige Scorer</a>
                        </li>
                        <li>
                            <a href="{{ route('historic-ananas-farmers') }}" class="text-gray-300" title="Ewige Ananas">Ewige Ananas</a>
                        </li>
                    </ul>
                </div>
                <div>
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a href="{{ route('logout') }}"
                                                       onclick="event.preventDefault();
                                this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Abmelden
                            </a>
                        </form>
                    @endauth
                    @guest
                        <a href="{{ route('login') }}" class="font-semibold tracking-wide text-gray-100" title="Login">
                            <i class="fas fa-sign-in-alt"></i> Anmelden
                        </a>
                    @endguest
                </div>
            </div>
            @foreach (\App\Models\Club::owner(true)->get() as $club)
                <div>
                    <p class="font-semibold tracking-wide text-gray-100">{{ $club->name_short }}</p>
                    <ul class="mt-2 space-y-2">
                        <li>
                            <a href="{{ route('club.schedule', $club) }}" class="text-gray-300">Spielplan</a>
                        </li>
                        <li>
                            <a href="{{ route('club.scorers', $club) }}" class="text-gray-300">Tore & Assists</a>
                        </li>
                        <li>
                            <a href="{{ route('club.sinners', $club) }}" class="text-gray-300">Karten</a>
                        </li>
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
    <div class="flex flex-col justify-between pt-5 pb-10 border-t sm:flex-row">
        <p class="text-sm text-gray-300">
            &copy; Copyright {{ \Carbon\Carbon::today()->isoFormat('Y') }} SW Bilk '79
        </p>
        <div class="flex items-center mt-4 space-x-4 sm:mt-0">
{{--            <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-400">--}}
{{--                <svg viewBox="0 0 24 24" fill="currentColor" class="h-5">--}}
{{--                    <path--}}
{{--                        d="M24,4.6c-0.9,0.4-1.8,0.7-2.8,0.8c1-0.6,1.8-1.6,2.2-2.7c-1,0.6-2,1-3.1,1.2c-0.9-1-2.2-1.6-3.6-1.6 c-2.7,0-4.9,2.2-4.9,4.9c0,0.4,0,0.8,0.1,1.1C7.7,8.1,4.1,6.1,1.7,3.1C1.2,3.9,1,4.7,1,5.6c0,1.7,0.9,3.2,2.2,4.1 C2.4,9.7,1.6,9.5,1,9.1c0,0,0,0,0,0.1c0,2.4,1.7,4.4,3.9,4.8c-0.4,0.1-0.8,0.2-1.3,0.2c-0.3,0-0.6,0-0.9-0.1c0.6,2,2.4,3.4,4.6,3.4 c-1.7,1.3-3.8,2.1-6.1,2.1c-0.4,0-0.8,0-1.2-0.1c2.2,1.4,4.8,2.2,7.5,2.2c9.1,0,14-7.5,14-14c0-0.2,0-0.4,0-0.6 C22.5,6.4,23.3,5.5,24,4.6z"--}}
{{--                    ></path>--}}
{{--                </svg>--}}
{{--            </a>--}}
{{--            <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-400">--}}
{{--                <svg viewBox="0 0 30 30" fill="currentColor" class="h-6">--}}
{{--                    <circle cx="15" cy="15" r="4"></circle>--}}
{{--                    <path--}}
{{--                        d="M19.999,3h-10C6.14,3,3,6.141,3,10.001v10C3,23.86,6.141,27,10.001,27h10C23.86,27,27,23.859,27,19.999v-10   C27,6.14,23.859,3,19.999,3z M15,21c-3.309,0-6-2.691-6-6s2.691-6,6-6s6,2.691,6,6S18.309,21,15,21z M22,9c-0.552,0-1-0.448-1-1   c0-0.552,0.448-1,1-1s1,0.448,1,1C23,8.552,22.552,9,22,9z"--}}
{{--                    ></path>--}}
{{--                </svg>--}}
{{--            </a>--}}
{{--            <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-400">--}}
{{--                <svg viewBox="0 0 24 24" fill="currentColor" class="h-5">--}}
{{--                    <path--}}
{{--                        d="M22,0H2C0.895,0,0,0.895,0,2v20c0,1.105,0.895,2,2,2h11v-9h-3v-4h3V8.413c0-3.1,1.893-4.788,4.659-4.788 c1.325,0,2.463,0.099,2.795,0.143v3.24l-1.918,0.001c-1.504,0-1.795,0.715-1.795,1.763V11h4.44l-1,4h-3.44v9H22c1.105,0,2-0.895,2-2 V2C24,0.895,23.105,0,22,0z"--}}
{{--                    ></path>--}}
{{--                </svg>--}}
{{--            </a>--}}
        </div>
    </div>
</div>
