<?php

namespace App\Http\Livewire\Admin;

use App\Models\PlayerStatus;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class PlayerStatusTable extends LivewireDatatable
{
    public $model = PlayerStatus::class;

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('desc'),
            Column::name('description')
                ->label('Beschreibung')
                ->searchable(),
            BooleanColumn::name('can_play')
                ->label('Kann spielen?'),
            Column::callback(['id'], function ($id) {
                return view('admin.includes.table-actions', ['id' => $id]);
            })
        ];
    }
}
