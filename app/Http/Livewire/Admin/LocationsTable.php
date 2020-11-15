<?php

namespace App\Http\Livewire\Admin;

use App\Models\Location;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class LocationsTable extends LivewireDatatable
{
    public $model = Location::class;

    public $exportable = true;

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('desc'),
            Column::name('name')
                ->label('Name')
                ->searchable(),
            Column::name('name_short')
                ->label('-Kurz'),
            BooleanColumn::name('is_stadium')
                ->label('Stadion?')
                ->alignCenter(),
            Column::name('url')
                ->label('URL'),
            Column::callback(['id'], function ($id) {
                return view('admin.includes.table-actions', ['id' => $id]);
            })
        ];
    }
}
