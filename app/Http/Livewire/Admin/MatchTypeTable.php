<?php

namespace App\Http\Livewire\Admin;

use App\Models\MatchType;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class MatchTypeTable extends LivewireDatatable
{
    public $model = MatchType::class;

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('desc'),
            Column::name('description')
                ->label('Beschreibung')
                ->searchable(),
            Column::name('description_short')
                ->label('Abk.')
                ->searchable(),
            Column::callback(['id'], function ($id) {
                return view('admin.includes.table-actions', ['id' => $id]);
            })
        ];
    }
}
