<div>
    @include('admin.includes.alert')

    <!-- delete confirmation -->
    <x-jet-confirmation-modal wire:model="is_open_delete">
        <x-slot name="title">
            Termin {{ $date->id }} löschen
        </x-slot>
        <x-slot name="content">
            <p>Möchten Sie diesen Termin wirklich löschen?</p>
            Löscht auch:
            <ul>

            </ul>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeDeleteModal()">
                Abbrechen
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="destroy({{ $date->id }})">
                Löschen
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
    <!-- create or maintain modal -->
    <x-jet-dialog-modal wire:model="is_open">
        <x-slot name="title">
            <div class="font-semibold">
                Termin
                    @if ($date->id)
                        ändern (ID: {{ $date->id }})
                    @else
                        anlegen - <span class="font-bold text-yellow-500">{{ $date->title }}</span>
                    @endif
            </div>
        </x-slot>
        <form class="w-full">
            @csrf
            <x-slot name="content">
                <div class="font-semibold text-lg w-full border-b border-green-300 mb-6">
                    Allgemeines
                </div>
                <!-- date type -->
                <div class="mb-6">
                    <x-jet-label class="text-green-600" for="date_type">
                        Art des Termins
                    </x-jet-label>
                    <div class="flex items-center">
                        <select id="date_type" wire:model="date.date_type_id" class="form-select shadow-sm" autocomplete="off">
                            <option selected="selected" value="">Bitte auswählen</option>
                            @foreach($date_types as $date_type)
                                <option value="{{ $date_type->id }}">{{ $date_type->description }}</option>
                            @endforeach
                        </select>
                        <div class="ml-2 text-green-500">
                            @isset($date->date_type_id)
                                @php
                                    $selectedDateType = \App\Models\DateType::find($date->date_type_id);
                                @endphp
                                @isset ($selectedDateType)
                                    {{ $selectedDateType->description }} ausgewählt
                                @endisset
                            @endisset
                        </div>
                    </div>
                    <x-jet-input-error for="date.date_type_id" />
                </div>
                @if($date->date_type_id && $date->date_type_id != "")
                    <!-- title and datetime -->
                    <div class="mb-6 flex items-center space-x-4">
                        <div class="w-4/6">
                            <x-jet-label class="text-green-600" for="title">
                                Titel
                            </x-jet-label>
                            <x-jet-input class="w-full" type="text" id="title" wire:model.lazy="date.title" />
                            <x-jet-input-error for="date.title" />
                        </div>
                        <div class="w-2/6">
                            @unless($date->date_type_id == 1)
                                <x-jet-label class="text-green-600" for="datetime">
                                    Wann?
                                </x-jet-label>
                                <x-jet-input class="w-full" type="datetime-local" id="datetime" wire:model.lazy="date.datetime" />
                                <x-jet-input-error for="date.datetime" />
                            @endunless
                        </div>
                    </div>
                    <!-- description and note -->
                    <div class="mb-6 flex items-center space-x-4">
                        <div class="w-4/6">
                            <x-jet-label class="text-green-600" for="description">
                                Beschreibung
                            </x-jet-label>
                            <textarea id="description" class="form-textarea w-full shadow-sm" wire:model.lazy="date.description">

                            </textarea>
                            <x-jet-input-error for="date.description" />
                        </div>
                        <div class="w-2/6">
                            <x-jet-label class="text-green-600" for="note">
                                Interne Notiz, nur für Admins sichtbar
                            </x-jet-label>
                            <textarea id="note" class="form-textarea w-full shadow-sm" wire:model.lazy="date.note">

                            </textarea>
                            <x-jet-input-error for="date.note" />
                        </div>
                    </div>
                    <!-- location -->
                    <div class="mb-6">
                        <x-jet-label class="text-green-600" for="location">
                            Wo?
                        </x-jet-label>
                        <select id="location" wire:model.lazy="date.location_id" class="form-select w-full shadow-sm">
                            <option selected="selected" value="">Nicht festgelegt</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">({{ $location->id }}) {{ $location->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- date published / cancelled -->
                    <div class="flex items-center space-x-4">
                        <div class="flex">
                            <x-jet-input wire:model="date.published" id="published" type="checkbox" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out shadow-sm"/>
                            <x-jet-label for="published" class="ml-2 block leading-5 text-green-600" >
                                Veröffentlichen?
                            </x-jet-label>
                        </div>
                        <div class="flex">
                            <x-jet-input wire:model="date.cancelled" id="cancelled" type="checkbox" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out shadow-sm"/>
                            <x-jet-label for="cancelled" class="ml-2 block leading-5 text-green-600" >
                                Abgesagt?
                            </x-jet-label>
                        </div>
                    </div>
                    <div class="mb-3">
                        @if ($date->published)
                            <span class="text-sm text-green-500">Termin für alle sichtbar.</span>
                        @else
                            <span class="text-sm text-yellow-500">Termin ist noch nicht sichtbar.</span>
                        @endif
                    </div>
                    <!-- poll options -->
                    <div class="font-semibold text-lg w-full border-b border-green-300 mb-3">
                        Die zugehörige Umfrage pflegen
                    </div>
                    <div class="bg-gray-100 p-1 mb-3">
                        <i class="far fa-fw fa-lightbulb"></i>
                        @isset ($selectedDateType)
                            @switch ($selectedDateType->id)
                                @case (1)
                                Bei Terminart {{ $selectedDateType->description }} sind mehrere Umfrageoptionen möglich.
                                @break
                                @case (2)
                                Bei Terminart {{ $selectedDateType->description }} ist nur eine Umfrageoption (Teilnahme) vorgesehen.
                                @break
                                @case (3)
                                Bei Terminart {{ $selectedDateType->description }}  ist nur eine Umfrageoption (Teilnahme) vorgesehen.
                                @break
                                @case (4)
                                Bei Terminart {{ $selectedDateType->description }}  sind mehrere Umfrageoptionen möglich.
                                @break
                            @endswitch
                        @endisset
                    </div>
                    <div class="mb-6 flex items-center space-x-4">
                        <div class="w-2/6">
                            <x-jet-label class="text-green-600" for="poll_begins">
                                Umfragebeginn
                            </x-jet-label>
                            <x-jet-input class="w-full" type="date" id="poll_begins" wire:model.lazy="date.poll_begins" />
                            <x-jet-input-error for="date.poll_begins" />
                        </div>
                        <div class="w-2/6">
                            <x-jet-label class="text-green-600" for="poll_ends">
                                Umfrageschluss
                            </x-jet-label>
                            <x-jet-input class="w-full" type="date" id="poll_ends" wire:model.lazy="date.poll_ends"/>
                            <x-jet-input-error for="date.poll_ends" />
                        </div>
                        <div class="flex space-x-2">
                            <x-jet-input wire:model="date.poll_is_open" id="poll_is_open" type="checkbox" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out shadow-sm" />
                            <x-jet-label class="ml-2 block leading-5 text-green-600" for="poll_is_open">
                                Umfrage offen?
                            </x-jet-label>
                        </div>
                    </div>
                    <div>
                        @if ($date->date_type_id == 1 || $date->date_type_id == 4)
                            <div class="mb-6 flex items-end space-x-4">
                                <div class="w-1/2">
                                    <x-jet-label class="text-green-600" for="date_option" >
                                        Umfrageoptionen
                                        <br>
                                        {{ $date_option }}
                                    </x-jet-label>
                                    <x-jet-input id="date_option" type="text" class="w-full" wire:model.lazy="date_option.description" />
                                </div>
                                <div class="flex">
                                    <x-jet-button wire:click="addDateOption()" class="w-full justify-center" >
                                        Hinzufügen
                                    </x-jet-button>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div>
                        {{ $date_options }}
                        @foreach ($date_options as $key => $value)
                            <div class="mb-6 flex items-end items-stretch space-x-4">
                                <div class="flex w-1/2 p-1 border border-gray-200 rounded bg-gray-100 text-gray-700">
                                    <x-jet-label class="text-green-600" for="">
                                        <span class="font-semibold">Option {{ $loop->iteration }}:</span>
                                    </x-jet-label>
                                    <x-jet-input id="date_option_description" type="text" class="w-full" wire:model="date_options.{{ $key }}.description"/>
                                </div>
                                <div class="flex">
                                    <x-jet-danger-button wire:click="removeDateOption({{ $key }})" class="w-full justify-center" >
                                        Entfernen
                                    </x-jet-danger-button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @switch ($date->date_type_id)
                        @case (2)
                            <div class="font-semibold text-lg w-full border-b border-green-300 mb-6">
                                Das zugehörige Spiel {{ $match->id ? "bearbeiten (ID: ".$match->id.")" : "anlegen" }}
                            </div>
                            <!-- match type -->
                            <div class="mb-6">
                                <x-jet-label class="text-green-600" for="match_type">
                                    Art des Spiels
                                </x-jet-label>
                                <div class="flex items-center">
                                    <select id="date_type" wire:model="match.match_type_id" class="form-select shadow-sm" autocomplete="off">
                                        <option selected="selected" value="">Bitte auswählen</option>
                                        @foreach($match_types as $match_type)
                                            <option value="{{ $match_type->id }}">{{ $match_type->description }}</option>
                                        @endforeach
                                    </select>
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
                                            <option value="{{ $club_home->id }}" {{ $match->teamh_home == $club_home->id ?: 'selected="selected"' }}>{{ $club_home->name }}</option>
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
                            @break
                        @case (3)
                            <div class="font-semibold text-lg w-full border-b border-green-300 mb-6">
                                Das zugehörige Turnier {{ $tournament->id ? "bearbeiten (ID: ".$tournament->id.")" : "anlegen" }}
                            </div>
                            <div class="mb-6">
                                <x-jet-label class="text-green-600" for="tournament_title">
                                    Titel des Turniers
                                </x-jet-label>
                                <x-jet-input class="w-full" type="text" id="tournament_title" wire:model.lazy="tournament.title" />
                                <x-jet-input-error for="tournament.title" />
                            </div>
                            <div class="mb-6">
                                <x-jet-label class="text-green-600" for="tournament_desc">
                                    Beschreibung des Turniers
                                </x-jet-label>
                                <x-jet-input class="w-full" type="text" id="tournament_desc" wire:model.lazy="tournament.description" />
                                <x-jet-input-error for="tournament.description" />
                            </div>
                            <div class="mb-6">
                                <x-jet-label class="text-green-600" for="tournament_place">
                                    Platz (Textfeld)
                                </x-jet-label>
                                <x-jet-input class="w-1/4" type="text" id="tournament_place" wire:model.lazy="tournament.place" />
                                <x-jet-input-error for="tournament.place" />
                            </div>
                            @break
                    @endswitch
                @endisset

            </x-slot>
            <x-slot name="footer">
                <div class="sm:flex sm:flex-row-reverse">
                    <x-jet-validation-errors />
                    <span class="flex w-full sm:w-auto mb-2 sm:mb-0 sm:ml-2">
                        @if ($date->date_type_id && $date->date_type_id != "")
                            <x-jet-button wire:click.prevent="store()" class="w-full justify-center" >
                                Speichern
                            </x-jet-button>
                        @endif
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
    {{-- create a new date, opens modal --}}
    <div class="mb-4 flex justify-center sm:justify-start">
        <x-confirmation-button wire:click="create()">
            Anlegen
        </x-confirmation-button>
    </div>
</div>
