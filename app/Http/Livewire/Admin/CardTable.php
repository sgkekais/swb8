<?php

namespace App\Http\Livewire\Admin;

use App\Models\Card;
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
            NumberColumn::name('match_id')
                ->label('Match')
                ->filterable(),
            NumberColumn::name('player_id')
                ->label('Spieler')
                ->filterable()
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
}
