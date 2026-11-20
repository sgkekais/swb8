<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Club;
use App\Models\Game;
use App\Models\MatchType;
use Arm092\LivewireDatatables\BooleanColumn;
use Arm092\LivewireDatatables\Column;
use Arm092\LivewireDatatables\DateColumn;
use Arm092\LivewireDatatables\NumberColumn;

class MatchTable extends Datatable
{
    public Model|string|null $model = Game::class;

    public function mount($model = false, $include = [], $exclude = [], $hide = [], $dates = [], $times = [], $searchable = [], $sortIndex = null, $hideHeader = null, $hidePagination = null, $perPage = null, $exportable = false, $hideable = false, $beforeTableSlot = false, $buttonsSlot = false, $afterTableSlot = false, $params = []): void
    {
        parent::mount($model, $include, $exclude, $hide, $dates, $times, $searchable, $sortIndex, $hideHeader, $hidePagination, $perPage, $exportable, $hideable, $beforeTableSlot, $buttonsSlot, $afterTableSlot, $params);

        $this->search = request('match_id');
    }

    public function getColumns(): array|Model
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->searchable(),
            Column::callback('date_id', function ($date_id) {
                 return "<a href='".route('admin.dates', ['date_id' => $date_id])."' class='text-blue-700'>".$date_id."</a>";
            })->label('Termin-ID'),
            DateColumn::name('date.datetime')
                ->label('Datum')
                ->format('Y-m-d H:i')
                ->searchable()
                ->defaultSort('desc'),
            Column::name('matchType.description_short')
                ->label('Art')
                ->alignCenter()
                ->filterable($this->match_type_description_short),
            Column::name('matchweek')
                ->label('SW')
                ->alignCenter(),
            // Column::name('teamHome.name')->label('Heim')->searchable(),
            Column::callback(['team_home'], function ($team_home) {
                if (Club::find($team_home))
                    return Club::find($team_home)->name;
                else
                    return null;
            })
                ->label('Heim'),
            Column::callback(['goals_home', 'goals_home_ht', 'goals_away', 'goals_away_ht', 'goals_home_pen', 'goals_away_pen', 'goals_home_rated', 'goals_away_rated'], function ($goals_home, $goals_home_ht, $goals_away, $goals_away_ht, $goals_home_pen, $goals_away_pen, $goals_home_rated, $goals_away_rated) {
                // cancelled, rated, penalties, result + half-time result
                return $goals_home.':'.$goals_away.' ('.$goals_home_ht.':'.$goals_away_ht.')'.' ['.$goals_home_pen.':'.$goals_away_pen.' i.E.]';
            })->label('Erg.')->alignCenter(),
            // Column::name('teamAway.name')->label('Gast')->searchable(),
            Column::callback(['team_away'], function ($team_away) {
                if (Club::find($team_away))
                    return Club::find($team_away)->name;
                else
                    return null;
            })->label('Gast'),
            Column::name('cards.id:count')
                ->label('Karten'),
            Column::name('goals.id:count')
                ->label('Tore'),
            Column::callback(['match_details'], function ($match_details) {
                return $match_details ? 'X' : null;
            })->label('Details?')->alignCenter(),
            BooleanColumn::name('cancelled')
                ->label('Ann.?')
                ->alignCenter(),
            BooleanColumn::name('published')
                ->label('Öffentl.?')
                ->alignCenter(),
            Column::callback(['id'], function ($id) {
                return view('admin.includes.table-actions', ['id' => $id]);
            })
        ];
    }

    public function teamNames()
    {
        return Club::all()->pluck('name');
    }

    public function getMatchTypeDescriptionShortProperty()
    {
        return MatchType::orderBy('description_short')->pluck('description_short');
    }
}
