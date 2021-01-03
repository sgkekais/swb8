<div>
    @include('admin.includes.alert')

    <x-jet-dialog-modal wire:model="is_open">
        <x-slot name="title">
            <div class="font-semibold">
                Paarung
                @if ($match->id)
                    ändern (ID: {{ $match->id }})
                @else
                    anlegen
                @endif
            </div>
        </x-slot>
        <form class="w-full">
            @csrf
            <x-slot name="content">
                <!-- match type and season-->
                <div class="mb-6 flex items-center space-x-4">
                    <div>
                        <x-jet-label class="text-green-600" for="match_type">
                            Art des Spiels
                        </x-jet-label>
                        <div class="flex items-center">
                            <select id="match_type" wire:model="match.match_type_id" class="form-select shadow-sm" autocomplete="off">
                                <option selected="selected" value="">Bitte auswählen</option>
                                @foreach($match_types as $match_type)
                                    <option value="{{ $match_type->id }}">{{ $match_type->description }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <x-jet-label class="text-green-600" for="season_id">
                            Saison
                        </x-jet-label>
                        <div class="flex items-center">
                            <select id="season_id" wire:model="match.season_id" class="form-select shadow-sm" autocomplete="off">
                                <option selected="selected" value="">Bitte auswählen</option>
                                @foreach($seasons as $season)
                                    <option value="{{ $season->id }}">{{ $season->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- home and away club + result -->
                <div class="mb-6 flex space-x-4 items-center">
                    <div class="flex-grow">
                        <x-jet-label class="text-green-600 text-center" for="match">
                            Heim
                        </x-jet-label>
                        <select id="match" wire:model="match.team_home" class="form-select w-full shadow-sm">
                            <option selected="selected">Nicht festgelegt</option>
                            @foreach($clubs as $club_home)
                                <option value="{{ $club_home->id }}">{{ $club_home->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- result -->
                    <div class="flex flex-col flex-none space-y-1 w-1/6">
                        <x-jet-label class="text-green-600 text-center" value="Ergebnis" />
                        <div class="flex flex-row items-center space-x-1">
                            <x-jet-input id="goals_home" type="text" class="w-full text-center" wire:model="match.goals_home" />
                            <span class="block">:</span>
                            <x-jet-input id="goals_away" type="text" class="w-full text-center" wire:model="match.goals_away" />
                        </div>
                        <x-jet-label class="text-green-600 text-center" value="Halbzeit" />
                        <div class="flex flex-row items-center space-x-1">
                            <x-jet-input id="goals_home_ht" type="text" class="w-full text-center" wire:model="match.goals_home_ht" />
                            <span class="block">:</span>
                            <x-jet-input id="goals_away_ht" type="text" class="w-full text-center" wire:model="match.goals_away_ht" />
                        </div>
                        <x-jet-label class="text-green-600 text-center" value="11m" />
                        <div class="flex flex-row items-center space-x-1">
                            <x-jet-input id="goals_home_pen" type="text" class="w-full text-center" wire:model="match.goals_home_pen" />
                            <span class="block">:</span>
                            <x-jet-input id="goals_away_pen" type="text" class="w-full text-center" wire:model="match.goals_away_pen" />
                        </div>
                        <x-jet-label class="text-green-600 text-center" value="Wertung" />
                        <div class="flex flex-row items-center space-x-1">
                            <x-jet-input id="goals_home_rated" type="text" class="w-full text-center" wire:model="match.goals_home_rated" />
                            <span class="block">:</span>
                            <x-jet-input id="goals_away_rated" type="text" class="w-full text-center" wire:model="match.goals_away_rated" />
                        </div>
                    </div>
                    <div class="flex-grow">
                        <x-jet-label class="text-green-600 text-center" for="match">
                            Gast
                        </x-jet-label>
                        <select id="match" wire:model="match.team_away" class="form-select w-full shadow-sm">
                            <option selected="selected">Nicht festgelegt</option>
                            @foreach($clubs as $club_away)
                                <option value="{{ $club_away->id }}">{{ $club_away->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- match details -->
                <div class="mb-6">
                    <x-jet-label class="text-green-600" for="match_details">
                        Spieldetails
                    </x-jet-label>
                    <textarea id="match_details" class="form-textarea w-full shadow-sm" wire:model="match.match_details">

                        </textarea>
                </div>
                <!-- match published / cancelled -->
                <div class="mb-6 flex items-center space-x-4">
                    <div class="flex">
                        <x-jet-input wire:model="match.published" id="published" type="checkbox" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out shadow-sm"/>
                        <x-jet-label class="text-green-600" for="published" class="ml-2 block leading-5" >
                            Veröffentlichen?
                        </x-jet-label>
                    </div>
                    <div class="flex">
                        <x-jet-input wire:model="match.cancelled" id="cancelled" type="checkbox" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out shadow-sm"/>
                        <x-jet-label class="text-green-600" for="cancelled" class="ml-2 block leading-5" >
                            Abgesagt?
                        </x-jet-label>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <div class="sm:flex sm:flex-row-reverse">
                    <span class="flex w-full sm:w-auto mb-2 sm:mb-0 sm:ml-2">
                        <x-jet-button wire:click.prevent="store()" class="w-full justify-center" >
                            Speichern
                        </x-jet-button>
                    </span>
                    <span class="flex w-full sm:w-auto">
                        <x-jet-secondary-button wire:click="closeModal()" wire:loading.attr="disabled" class="w-full justify-center">
                            Abbrechen
                        </x-jet-secondary-button>
                    </span>
                </div>
            </x-slot>
        </form>
    </x-jet-dialog-modal>
    {{-- create a new match, opens modal
    <div class="mb-4 flex justify-center sm:justify-start">
        <span class="block shadow-xl rounded-md">
            <button wire:click="create()" class="btn btn-blue px-4 py-2">
                Anlegen
            </button>
        </span>
    </div>--}}
</div>
