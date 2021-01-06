<?php

namespace App\Http\Livewire\Admin;

use App\Models\Season;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class SeasonTable extends LivewireDatatable
{
    public $model = Season::class;

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID'),
            NumberColumn::name('number')
                ->label('Nr.')
                ->searchable()
                ->defaultSort('desc'),
            Column::name('title')
                ->label('Titel')
                ->searchable(),
            Column::name('description')
                ->label('Beschreibung')
                ->truncate(50)
                ->searchable(),
            BooleanColumn::name('is_ah_season')
                ->filterable(),
            Column::callback(['id'], function ($id) {
                return view('admin.includes.table-actions', ['id' => $id]);
            })
        ];
    }
}
