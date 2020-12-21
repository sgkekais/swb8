<?php

namespace App\Http\Livewire\Admin;

use App\Models\Goal;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class GoalTable extends LivewireDatatable
{
    public $model = Goal::class;

    public $exportable = true;

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
}
