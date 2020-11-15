<?php

namespace App\Http\Livewire\Admin;

use App\Models\Club;
use App\Models\Match;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class MatchTable extends LivewireDatatable
{
    public $model = Match::class;

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('desc'),
            Column::name('matchType.description_short')
                ->label('Art')
                ->alignCenter(),
            Column::name('matchweek')
                ->label('SW')
                ->alignCenter(),
            Column::callback(['team_home'], function ($team_home) {
                return Club::find($team_home)->name;
            })->label('Heim'),
            Column::callback(['goals_home', 'goals_home_ht', 'goals_away', 'goals_away_ht'], function ($goals_home, $goals_home_ht, $goals_away, $goals_away_ht) {
                // cancelled, rated, penalties, result + half-time result
                return $goals_home.':'.$goals_away.' ('.$goals_home_ht.':'.$goals_away_ht.')';
            })->label('Ergebnis')->alignCenter(),
            Column::callback(['team_away'], function ($team_away) {
                return Club::find($team_away)->name;
            })->label('Auswärts'),
            Column::callback(['match_details'], function ($match_details) {
                return $match_details ? 'X' : null;
            })->label('Details?')->alignCenter(),
            BooleanColumn::name('cancelled')
                ->label('Annulliert?')
                ->alignCenter(),
            BooleanColumn::name('published')
                ->label('Öffentl.?')
                ->alignCenter(),
            Column::callback(['id'], function ($id) {
                return view('admin.includes.table-actions', ['id' => $id]);
            })
        ];
    }
}
