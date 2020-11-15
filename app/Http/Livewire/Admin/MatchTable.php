<?php

namespace App\Http\Livewire\Admin;

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
                ->label('Spielwoche'),
            Column::name('teamHome.name')
                ->label('Heim'),
            Column::name('teamAway.name')
                ->label('Auswärts'),
            Column::callback(['goals_home', 'goals_home_ht', 'goals_away', 'goals_away_ht'], function ($goals_home, $goals_home_ht, $goals_away, $goals_away_ht) {
                // cancelled, rated, penalties, result + half-time result
                return $goals_home.':'.$goals_away.' ('.$goals_home_ht.':'.$goals_away_ht.')';
            })->label('Ergebnis')->alignCenter(),
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
