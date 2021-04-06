<?php

namespace App\Http\Livewire\Admin;

use App\Models\Club;
use App\Models\Match;
use App\Models\MatchType;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class MatchTable extends LivewireDatatable
{
    public $model = Match::class;

    public function mount($model = null, $include = [], $exclude = [], $hide = [], $dates = [], $times = [], $searchable = [], $sort = null, $hideHeader = null, $hidePagination = null, $perPage = 10, $exportable = false, $hideable = false, $beforeTableSlot = false, $afterTableSlot = false, $params = [])
    {
        parent::mount($model, $include, $exclude, $hide, $dates, $times, $searchable, $sort, $hideHeader, $hidePagination, $perPage, $exportable, $hideable, $beforeTableSlot, $afterTableSlot, $params);

        $this->search = request('match_id');
    }

    public function columns()
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
                return Club::find($team_home)->name;
            })
                ->label('Heim'),
            Column::callback(['goals_home', 'goals_home_ht', 'goals_away', 'goals_away_ht', 'goals_home_pen', 'goals_away_pen', 'goals_home_rated', 'goals_away_rated'], function ($goals_home, $goals_home_ht, $goals_away, $goals_away_ht, $goals_home_pen, $goals_away_pen, $goals_home_rated, $goals_away_rated) {
                // cancelled, rated, penalties, result + half-time result
                return $goals_home.':'.$goals_away.' ('.$goals_home_ht.':'.$goals_away_ht.')'.' ['.$goals_home_pen.':'.$goals_away_pen.' i.E.]';
            })->label('Erg.')->alignCenter(),
            // Column::name('teamAway.name')->label('Gast')->searchable(),
            Column::callback(['team_away'], function ($team_away) {
                return Club::find($team_away)->name;
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
