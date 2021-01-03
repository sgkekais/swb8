<?php

namespace App\Http\Livewire\Admin;

use App\Models\Card;
use App\Models\Player;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class CardTable extends LivewireDatatable
{
    public $model = Card::class;

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
            /*NumberColumn::name('match_id')
                ->label('Match')
                ->filterable(),*/
            Column::name('player.nickname')
                ->label('Spieler')
                ->filterable($this->players)
                ->searchable(),
            Column::name('color')
                ->label('Karte')
                ->alignCenter()
                ->filterable(),
            Column::name('note')
                ->truncate()
                ->label('Notiz')
        ];
    }

    public function getPlayersProperty ()
    {
        return Player::orderBy('nickname')->pluck('nickname');
    }
}
