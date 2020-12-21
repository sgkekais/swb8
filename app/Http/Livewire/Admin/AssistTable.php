<?php

namespace App\Http\Livewire\Admin;

use App\Models\Assist;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class AssistTable extends LivewireDatatable
{
    public $model = Assist::class;

    public $exportable = true;

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('desc'),
            NumberColumn::name('goal_id')
                ->label('Tor')
                ->searchable()
                ->filterable(),
            NumberColumn::name('player_id')
                ->label('Spieler')
                ->filterable()
                ->searchable()
        ];
    }
}
