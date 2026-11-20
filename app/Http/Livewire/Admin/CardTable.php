<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Card;
use App\Models\Player;
use Arm092\LivewireDatatables\BooleanColumn;
use Arm092\LivewireDatatables\Column;
use Arm092\LivewireDatatables\NumberColumn;

class CardTable extends Datatable
{
    public Model|string|null $model = Card::class;

    public bool $exportable = true;

    public ?int $perPage = 15;

    public function getColumns(): array|Model
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
