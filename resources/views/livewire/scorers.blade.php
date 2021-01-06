<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6">
            <label for="selected_season" class="font-bold text-primary-600">
                Saison auswählen
            </label>
            <select name="selected_season" wire:model="selected_season">
                @foreach ($seasons as $season)
                    <option value="{{ $season->id }}">{{ $season->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="table">
            @foreach($scorers->sortByDesc('goals_count') as $scorer)
                <div class="table-row-group">
                    <div class="table-cell">
                        {{ \App\Models\Player::find($scorer->player_id)->nickname }}
                    </div>
                    <div class="table-cell">
                        {{ $scorer->goals_count }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
