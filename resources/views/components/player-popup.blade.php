@props(
    ['player' => null]
)

@if ($player)
    <x-box-with-shadow class="p-4" shadow-color="bg-gray-600">
        <div class="flex flex-col space-y-1">
            <div class="flex items-center space-x-4">
                @isset($player->user)
                    <img class="h-16 w-16 rounded-full object-cover" src="{{ $player->user->profile_photo_url }}" alt="{{ $player->first_name }}" />
                @else
                    <img class="inline-flex h-16 w-16 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ $player->name }}&color=FFFFFF&background=505050" />
                @endisset
                <div class="flex flex-col space-y-1">
                    <div>{{ $player->full_name }}</div>
                    <div class="text-sm font-bold text-yellow-500">{{ $player->public_note }}</div>
                    <div class="flex items-center space-x-2 text-sm font-bold">
                        @foreach ($player->clubs as $club)
                            <span class="p-1 bg-primary-700 text-white">{{ $club->name_code }}</span>
                            @if ($club->pivot->number)
                                <span class="text-lg">#{{ $club->pivot->number }}</span>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @if ($player->joined)
                <div class="text-gray-700">
                    <i class="fas fa-birthday-cake"></i> Dabei seit {{ $player->joined->isoFormat('MM.Y') }} ({{ $player->joined->diffInYears() > 0 ? $player->joined->diffInYears()." J." : $player->joined->diffInMonths()." M." }})
                </div>
            @endif
            <div class="flex items-center space-x-4 text-gray-700">
                <div>
                    <i class="far fa-futbol"></i> {{ $player->goals()->count() }}
                </div>
                <div>
                    <i class="fas fa-hands-helping"></i> {{ $player->assists()->count() }}
                </div>
                <div>
                    <i class="far fa-copy"></i> {{ $player->cards()->count() }}
                </div>
            </div>
        </div>
    </x-box-with-shadow>
@endif
