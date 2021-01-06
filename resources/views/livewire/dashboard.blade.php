<div>
    <div class="w-full">
        <h2 class="font-sans font-extrabold text-2xl tracking-tighter">
            VS
        </h2>
    </div>
    <div class="mt-6">
        <label for="selected_player" class="font-bold text-primary-600 text-lg">
            Kontrahent:
        </label>
        <select name="selected_player" wire:model="selected_player">
            <option>Bitte auswählen</option>
            @foreach ($players as $player)
                <option value="{{ $player->id }}">{{ $player->nickname }}</option>
            @endforeach
        </select>
    </div>
    <!-- nicknames -->
    <div class="mt-6 flex items-center w-full font-extrabold text-2xl tracking-tighter">
        <div class="w-1/3">
            <h3 class="font-sans ">
                {{ $user_player->nickname }}
            </h3>
        </div>
        <div class="w-1/3 text-center">
            <h3 class="font-mono ">
                VS
            </h3>
        </div>
        <div class="w-1/3 text-right">
            <h3 class="font-sans ">
                {{ $vs_player->nickname }}
            </h3>
        </div>
    </div>
    <!-- cards -->
    <div class="py-3 tracking-tighter border-b border-gray-300">
        <div class="font-bold text-xl flex items-center w-full">
            <div class="w-1/3">
                <h3 class="font-sans ">
                    {{ $user_player->cards->count() }}
                </h3>
            </div>
            <div class="w-1/3 text-center">
                <h3 class="font-mono uppercase">
                    Karten
                </h3>
            </div>
            <div class="w-1/3 text-right">
                <h3 class="font-sans ">
                    {{ $vs_player->cards->count() }}
                </h3>
            </div>
        </div>
        <div class="flex items-center py-2">
            @unless($user_player->cards->count() == 0 && $vs_player->cards->count() == 0)
                <div class="h-2 bg-primary-600" style="width: {{ ceil(($user_player->cards->count() / ($user_player->cards->count() + $vs_player->cards->count()))*100) }}%">

                </div>
                <div class="h-2 bg-gray-600" style="width: {{ ceil(($vs_player->cards->count() / ($user_player->cards->count() + $vs_player->cards->count()))*100) }}%">

                </div>
            @endunless
        </div>
        <!-- yellows -->
        <div class="flex items-center w-full">
            <div class="w-1/3">
                <h3 class="font-sans ">
                    {{ $user_player->cards->where('color', 'gelb')->count() }}
                </h3>
            </div>
            <div class="w-1/3 text-center">
                <h3 class="font-mono uppercase">
                    Gelbe
                </h3>
            </div>
            <div class="w-1/3 text-right">
                <h3 class="font-sans ">
                    {{ $vs_player->cards->where('color', 'gelb')->count() }}
                </h3>
            </div>
        </div>
        <div class="flex items-center py-2">
            @unless($user_player->cards->where('color', 'gelb')->count() == 0 && $vs_player->cards->where('color', 'gelb')->count() == 0)
                <div class="h-2 bg-primary-600" style="width: {{ ceil(($user_player->cards->where('color', 'gelb')->count() / ($user_player->cards->where('color', 'gelb')->count() + $vs_player->cards->where('color', 'gelb')->count()))*100) }}%">

                </div>
                <div class="h-2 bg-gray-600" style="width: {{ ceil(($vs_player->cards->where('color', 'gelb')->count() / ($user_player->cards->where('color', 'gelb')->count() + $vs_player->cards->where('color', 'gelb')->count()))*100) }}%">

                </div>
            @else
                <div class="w-full h-2 bg-gray-300"></div>
            @endunless
        </div>
        <!-- yellow-reds -->
        <div class="flex items-center w-full">
            <div class="w-1/3">
                <h3 class="font-sans ">
                    {{ $user_player->cards->where('color', 'gelb-rot')->count() }}
                </h3>
            </div>
            <div class="w-1/3 text-center">
                <h3 class="font-mono uppercase">
                    Gelb-Rote
                </h3>
            </div>
            <div class="w-1/3 text-right">
                <h3 class="font-sans ">
                    {{ $vs_player->cards->where('color', 'gelb-rot')->count() }}
                </h3>
            </div>
        </div>
        <div class="flex items-center py-2">
            @unless ($user_player->cards->where('color', 'gelb-rot')->count() == 0 && $vs_player->cards->where('color', 'gelb-rot')->count() == 0)
                <div class="h-2 bg-primary-600" style="width: {{ ceil(($user_player->cards->where('color', 'gelb-rot')->count() / ($user_player->cards->where('color', 'gelb-rot')->count() + $vs_player->cards->where('color', 'gelb-rot')->count()))*100) }}%">

                </div>
                <div class="h-2 bg-gray-600" style="width: {{ ceil(($vs_player->cards->where('color', 'gelb-rot')->count() / ($user_player->cards->where('color', 'gelb-rot')->count() + $vs_player->cards->where('color', 'gelb-rot')->count()))*100) }}%">

                </div>
            @else
                <div class="w-full h-2 bg-gray-300"></div>
            @endunless
        </div>
        <!-- reds -->
        <div class="flex items-center w-full">
            <div class="w-1/3">
                <h3 class="font-sans ">
                    {{ $user_player->cards->where('color', 'rot')->count() }}
                </h3>
            </div>
            <div class="w-1/3 text-center">
                <h3 class="font-mono uppercase">
                    Rote
                </h3>
            </div>
            <div class="w-1/3 text-right">
                <h3 class="font-sans ">
                    {{ $vs_player->cards->where('color', 'rot')->count() }}
                </h3>
            </div>
        </div>
        <div class="flex items-center py-2">
            @unless ($user_player->cards->where('color', 'rot')->count() == 0 && $vs_player->cards->where('color', 'rot')->count() == 0)
                <div class="h-2 bg-primary-600" style="width: {{ ceil(($user_player->cards->where('color', 'rot')->count() / ($user_player->cards->where('color', 'rot')->count() + $vs_player->cards->where('color', 'rot')->count()))*100) }}%">

                </div>
                <div class="h-2 bg-gray-600" style="width: {{ ceil(($vs_player->cards->where('color', 'rot')->count() / ($user_player->cards->where('color', 'rot')->count() + $vs_player->cards->where('color', 'rot')->count()))*100) }}%">

                </div>
            @else
                <div class="w-full h-2 bg-gray-300"></div>
            @endunless
        </div>
        <!-- time pen -->
        <div class="flex items-center w-full">
            <div class="w-1/3">
                <h3 class="font-sans ">
                    {{ $user_player->cards->where('color', '10min')->count() }}
                </h3>
            </div>
            <div class="w-1/3 text-center">
                <h3 class="font-mono uppercase">
                    10 Min.
                </h3>
            </div>
            <div class="w-1/3 text-right">
                <h3 class="font-sans ">
                    {{ $vs_player->cards->where('color', '10min')->count() }}
                </h3>
            </div>
        </div>
        <div class="flex items-center py-2">
            @unless ($user_player->cards->where('color', '10min')->count() == 0 && $vs_player->cards->where('color', '10min')->count() == 0)
                <div class="h-2 bg-primary-600" style="width: {{ ceil(($user_player->cards->where('color', '10min')->count() / ($user_player->cards->where('color', '10min')->count() + $vs_player->cards->where('color', '10min')->count()))*100) }}%">

                </div>
                <div class="h-2 bg-gray-600" style="width: {{ ceil(($vs_player->cards->where('color', '10min')->count() / ($user_player->cards->where('color', '10min')->count() + $vs_player->cards->where('color', '10min')->count()))*100) }}%">

                </div>
            @else
                <div class="w-full h-2 bg-gray-300"></div>
            @endunless
        </div>
    </div>
    <!-- goals -->
    <div class="py-3 tracking-tighter border-b border-gray-300">
        <div class="font-bold text-xl flex items-center w-full ">
            <div class="w-1/3">
                <h3 class="font-sans ">
                    {{ $user_player->goals->count() }}
                </h3>
            </div>
            <div class="w-1/3 text-center">
                <h3 class="font-mono uppercase">
                    Tore
                </h3>
            </div>
            <div class="w-1/3 text-right">
                <h3 class="font-sans ">
                    {{ $vs_player->goals->count() }}
                </h3>
            </div>
        </div>
        <div class="flex items-center py-2">
            @unless ($user_player->goals->count() == 0 && $vs_player->goals->count() == 0)
                <div class="h-2 bg-primary-600" style="width: {{ ceil(($user_player->goals->count() / ($user_player->goals->count() + $vs_player->goals->count()))*100) }}%">

                </div>
                <div class="h-2 bg-gray-600" style="width: {{ ceil(($vs_player->goals->count() / ($user_player->goals->count() + $vs_player->goals->count()))*100) }}%">

                </div>
            @else
                <div class="w-full h-2 bg-gray-300"></div>
            @endunless
        </div>
        <!-- penalties -->
        <div class="flex items-center w-full">
            <div class="w-1/3">
                <h3 class="font-sans ">
                    {{ $user_player->goals->where('penalty', 1)->count() }}
                </h3>
            </div>
            <div class="w-1/3 text-center">
                <h3 class="font-mono uppercase">
                    11m
                </h3>
            </div>
            <div class="w-1/3 text-right">
                <h3 class="font-sans ">
                    {{ $vs_player->goals->where('penalty', 1)->count() }}
                </h3>
            </div>
        </div>
        <div class="flex items-center py-2">
            @unless ($user_player->goals->where('penalty', 1)->count() == 0 && $vs_player->goals->where('penalty', 1)->count() == 0)
                <div class="h-2 bg-primary-600" style="width: {{ ceil(($user_player->goals->where('penalty', 1)->count() / ($user_player->goals->where('penalty', 1)->count() + $vs_player->goals->where('penalty', 1)->count()))*100) }}%">

                </div>
                <div class="h-2 bg-gray-600" style="width: {{ ceil(($vs_player->goals->where('penalty', 1)->count() / ($user_player->goals->where('penalty', 1)->count() + $vs_player->goals->where('penalty', 1)->count()))*100) }}%">

                </div>
            @else
                <div class="w-full h-2 bg-gray-300"></div>
            @endunless
        </div>
    </div>
    <!-- assists -->
    <div class="py-3 font-bold text-xl tracking-tighter border-b border-gray-300">
        <div class="flex items-center w-full ">
            <div class="w-1/3">
                <h3 class="font-sans ">
                    {{ $user_player->assists->count() }}
                </h3>
            </div>
            <div class="w-1/3 text-center">
                <h3 class="font-mono uppercase">
                    Assists
                </h3>
            </div>
            <div class="w-1/3 text-right">
                <h3 class="font-sans ">
                    {{ $vs_player->assists->count() }}
                </h3>
            </div>
        </div>
        <div class="flex items-center py-2">
            @unless ($user_player->assists->count() == 0 && $vs_player->assists->count() == 0)
                <div class="h-2 bg-primary-600" style="width: {{ ceil(($user_player->assists->count() / ($user_player->assists->count() + $vs_player->assists->count()))*100) }}%">

                </div>
                <div class="h-2 bg-gray-600" style="width: {{ ceil(($vs_player->assists->count() / ($user_player->assists->count() + $vs_player->assists->count()))*100) }}%">

                </div>
            @else
                <div class="w-full h-2 bg-gray-300"></div>
            @endunless
        </div>
    </div>
</div>
