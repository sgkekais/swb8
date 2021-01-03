<?php

namespace App\Http\Livewire\Admin;

use App\Models\Goal;
use App\Models\Player;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class GoalTable extends LivewireDatatable
{
    public $model = Goal::class;

    public $exportable = true;

    public $perPage = 15;

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('desc'),
            Column::callback('match_id', function ($match_id) {
                return "<a href='".route('admin.matches', ['match_id' => $match_id])."' class='text-blue-700'>".$match_id."</a>";
            })->label('Match-ID'),
            Column::name('player.nickname')
                ->label('Spieler')
                ->filterable($this->players)
                ->searchable(),
            Column::name('score')
                ->label('Ergebnis')
                ->alignCenter()
                ->filterable(),
            BooleanColumn::name('penalty')
                ->label('11m')
                ->alignCenter()
                ->filterable()
        ];
    }

    public function getPlayersProperty ()
    {
        return Player::orderBy('nickname')->pluck('nickname');
    }

}
