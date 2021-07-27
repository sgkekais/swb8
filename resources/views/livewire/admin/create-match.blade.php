<div>
    @include('admin.includes.alert')

    @if ($match)
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
            <div class="w-full">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
            <form class="w-full">
                @csrf
                <x-slot name="content">
                    <!-- match type and season-->
                    <div class="mb-6 flex items-center space-x-4">
                        <div>
                            <x-jet-label class="" for="match_type">
                                Art des Spiels
                            </x-jet-label>
                            <x-select id="match_type" wire:model.defer="match.match_type_id" class="" autocomplete="off">
                                <option selected="selected" value="">Bitte auswählen</option>
                                @foreach($match_types as $match_type)
                                    <option value="{{ $match_type->id }}">{{ $match_type->description }}</option>
                                @endforeach
                            </x-select>
                            <x-jet-input-error for="match.match_type_id" />
                        </div>
                        <div>
                            <x-jet-label class="" for="season_id">
                                Saison
                            </x-jet-label>
                            <x-select id="season_id" wire:model.defer="match.season_id" class="" autocomplete="off">
                                <option selected="selected" value="">Bitte auswählen</option>
                                @foreach($seasons as $season)
                                    <option value="{{ $season->id }}">{{ $season->title }}</option>
                                @endforeach
                            </x-select>
                            <x-jet-input-error for="match.season_id" />
                        </div>
                        <div>
                            <x-jet-label for="match.matchweek">
                                Spielwoche
                            </x-jet-label>
                            <x-input-text type="text" id="match.matchweek" wire:model.defer="match.matchweek" />
                            <x-jet-input-error for="match.matchweek" />
                        </div>
                    </div>
                    <!-- home and away club + result -->
                    <div class="mb-6 flex space-x-4 items-center">
                        <div class="flex-grow">
                            <x-jet-label class="text-green-600 text-center" for="team_home">
                                Heim
                            </x-jet-label>
                            <x-select id="team_home" wire:model.defer="match.team_home" class="w-full" >
                                <option>Nicht festgelegt</option>
                                @foreach($clubs as $club_home)
                                    <option value={{ $club_home->id }}>{{ $club_home->name }}</option>
                                @endforeach
                            </x-select>
                            <x-jet-input-error for="match.team_home" />
                        </div>
                        <!-- result -->
                        <div class="flex flex-col flex-none space-y-1 w-1/6">
                            <x-jet-label class="text-green-600 text-center" value="Ergebnis" />
                            <div class="flex flex-row items-center space-x-1">
                                <x-input-text id="goals_home" type="number" class="w-full text-center" wire:model.defer="match.goals_home" />
                                <span class="block">:</span>
                                <x-input-text id="goals_away" type="number" class="w-full text-center" wire:model.defer="match.goals_away" />
                            </div>
                            <x-jet-label class="text-green-600 text-center" value="Halbzeit" />
                            <div class="flex flex-row items-center space-x-1">
                                <x-input-text id="goals_home_ht" type="number" class="w-full text-center" wire:model.defer="match.goals_home_ht" />
                                <span class="block">:</span>
                                <x-input-text id="goals_away_ht" type="number" class="w-full text-center" wire:model.defer="match.goals_away_ht" />
                            </div>
                            <x-jet-label class="text-green-600 text-center" value="11m" />
                            <div class="flex flex-row items-center space-x-1">
                                <x-input-text id="goals_home_pen" type="number" class="w-full text-center" wire:model.defer="match.goals_home_pen" />
                                <span class="block">:</span>
                                <x-input-text id="goals_away_pen" type="number" class="w-full text-center" wire:model.defer="match.goals_away_pen" />
                            </div>
                            <x-jet-label class="text-green-600 text-center" value="Wertung" />
                            <div class="flex flex-row items-center space-x-1">
                                <x-input-text id="goals_home_rated" type="number" class="w-full text-center" wire:model.defer="match.goals_home_rated" />
                                <span class="block">:</span>
                                <x-input-text id="goals_away_rated" type="number" class="w-full text-center" wire:model.defer="match.goals_away_rated" />
                            </div>
                            <div>
                                <x-jet-input-error for="match.goals_home" />
                                <x-jet-input-error for="match.goals_away" />
                                <x-jet-input-error for="match.goals_home_ht" />
                                <x-jet-input-error for="match.goals_away_ht" />
                                <x-jet-input-error for="match.goals_home_pen" />
                                <x-jet-input-error for="match.goals_away_pen" />
                                <x-jet-input-error for="match.goals_home_rated" />
                                <x-jet-input-error for="match.goals_rated" />
                            </div>
                        </div>
                        <div class="flex-grow">
                            <x-jet-label class="text-green-600 text-center" for="team_away">
                                Gast
                            </x-jet-label>
                            <x-select id="team_away" wire:model.defer="match.team_away" class="w-full" >
                                <option>Nicht festgelegt</option>
                                @foreach($clubs as $club_away)
                                    <option value={{ $club_away->id }}>{{ $club_away->name }}</option>
                                @endforeach
                            </x-select>
                            <x-jet-input-error for="match.team_away" />
                        </div>
                    </div>
                    <!-- match details -->
                    <div class="mb-6">
                        <x-jet-label class="" for="match_details">
                            Spieldetails
                        </x-jet-label>
                        <x-rich-text class="trix-content" wire:model.lazy="match.match_details" :initial-value="$match->match_details" wire:key="{{ $match->id }}"></x-rich-text>
                        <x-jet-input-error for="match.match_details" />
                    </div>
                    <!-- match published / cancelled -->
                    <div class="mb-6 flex items-center space-x-4">
                        <x-input-checkbox wire:model="match.published" id="published" />
                        <x-input-checkbox-label for="published">
                            Veröffentlichen?
                        </x-input-checkbox-label>
                        <x-input-checkbox  wire:model="match.cancelled" id="cancelled" />
                        <x-input-checkbox-label for="cancelled">
                            Abgesagt?
                        </x-input-checkbox-label>
                    </div>
                    <!-- cards -->
                    <div class="mb-6">
                        <div class="border-b border-gray-300">
                            <h2 class="font-sans font-extrabold text-lg tracking-tighter uppercase text-primary-600">Karten</h2>
                        </div>
                        <div class="py-2 flex items-center space-x-2">
                            <div>
                                <x-jet-label for="player">
                                    Spieler
                                </x-jet-label>
                                <select id="player" wire:model="card_to_be_added.0.player" autocomplete="off" >
                                    <option selected="selected" value="">Bitte auswählen</option>
                                    @foreach($players_of_club as $player)
                                        <option value="{{ $player->id }}">{{ $player->full_name_short }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-jet-label for="color">
                                    Farbe
                                </x-jet-label>
                                <x-select id="color" wire:model="card_to_be_added.0.color" autocomplete="off" >
                                    <option selected="selected" value="">Bitte auswählen</option>
                                    <option value="gelb">Gelb</option>
                                    <option value="10min">10 Min.</option>
                                    <option value="gelb-rot">Gelb-Rot</option>
                                    <option value="red">Rot</option>
                                </x-select>
                            </div>
                            <div>
                                <x-jet-label for="note">
                                    Notiz
                                </x-jet-label>
                                <x-input-text id="note" type="text" wire:model="card_to_be_added.0.note" />
                            </div>
                            <x-confirmation-button wire:click="addCard" target="addCard">
                                Hinzufügen
                            </x-confirmation-button>
                        </div>
                        @foreach ($match->cards as $card)
                            <div class="py-2 flex items-center space-x-2">
                                <x-button class="" wire:click="deleteCard({{ $card }})">
                                    <i class="far fa-trash-alt fa-fw text-red-500" title="Löschen"></i>
                                </x-button>
                                <div class="text-center text-gray-700">
                                    {{ $card->id }}
                                </div>
                                <div>
                                    {{ $card->color }}
                                </div>
                                <div class="">
                                    {{ $card->player->full_name_short }}
                                </div>
                                <div class="italic">
                                    {{ $card->note }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- goals and assists -->
                    <div class="mb-6">
                        <div class="border-b border-gray-300">
                            <h2 class="font-sans font-extrabold text-lg tracking-tighter uppercase text-primary-600">Tore</h2>
                        </div>
                        <div class="py-2 flex items-center space-x-2">
                            <div>
                                <x-jet-label for="player">
                                    Spieler
                                </x-jet-label>
                                <x-select id="player" wire:model="goal_to_be_added.0.player" autocomplete="off" >
                                    <option selected="selected" value="">Bitte auswählen</option>
                                    @foreach($players_of_club->sortBy('first_name') as $player)
                                        <option value="{{ $player->id }}">{{ $player->full_name_short }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div>
                                <x-jet-label for="minute">
                                    Minute
                                </x-jet-label>
                                <x-input-text id="minute" type="text" wire:model="goal_to_be_added.0.minute" />
                            </div>
                            <div>
                                <x-jet-label for="score">
                                    Stand
                                </x-jet-label>
                                <x-input-text id="score" type="text" wire:model="goal_to_be_added.0.score" />
                            </div>
                            <div>
                                <x-jet-label for="assist">
                                    Vorlage
                                </x-jet-label>
                                <x-select id="assist" wire:model="goal_to_be_added.0.assist" autocomplete="off" >
                                    <option selected="selected" value="">Bitte auswählen</option>
                                    @foreach($players_of_club as $player)
                                        <option value="{{ $player->id }}">{{ $player->full_name_short }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div class="flex items-center space-x-2">
                                <x-input-checkbox wire:model="goal_to_be_added.0.penalty" id="penalty" />
                                <x-input-checkbox-label for="penalty">
                                    11m?
                                </x-input-checkbox-label>
                            </div>
                            <x-confirmation-button wire:click="addGoal" target="addGoal">
                                Hinzufügen
                            </x-confirmation-button>
                        </div>
                        @foreach ($match->goals as $goal)
                            <div class="py-2 flex items-center space-x-2">
                                <x-button class="" wire:click="deleteGoal({{ $goal }})">
                                    <i class="far fa-trash-alt fa-fw text-red-500" title="Löschen"></i>
                                </x-button>
                                <div class="text-center text-gray-700">
                                    {{ $goal->id }}
                                </div>
                                <div>
                                    {{ $goal->minute ? $goal->minute."'" : "-" }}
                                </div>
                                <div>
                                    {{ $goal->score }}
                                </div>
                                <div>
                                    {{ $goal->penalty ? "(11m)" : null }}
                                </div>
                                <div class="">
                                    {{ $goal->player->full_name_short }}
                                </div>
                                <div>
                                    @if ($goal->assist)
                                        | Vorlage: <span class="text-gray-700">{{ $goal->assist->id }}</span> {{ $goal->assist->player->full_name_short }}
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <div class="sm:flex sm:flex-row-reverse">
                        <span class="flex w-full sm:w-auto mb-2 sm:mb-0 sm:ml-2">
                            <x-confirmation-button wire:click.prevent="store()" >
                                Speichern
                            </x-confirmation-button>
                        </span>
                        <span class="flex w-full sm:w-auto">
                            <x-button wire:click="closeModal()" wire:loading.attr="disabled" >
                                Abbrechen
                            </x-button>
                        </span>
                    </div>
                </x-slot>
            </form>
        </x-jet-dialog-modal>
    @endif

</div>

@push('scripts')
    <script src="https://unpkg.com/trix@1.3.1/dist/trix.js"></script>
@endpush
