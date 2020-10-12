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

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID'),
            Column::name('name')
                ->label('Name')
                ->defaultSort('asc')
                ->searchable(),
            Column::name('name_short')
                ->label('-Kurz'),
            BooleanColumn::name('is_stadium')
                ->label('Stadion?'),
            Column::name('url')
                ->label('URL'),
            Column::delete()
                ->label('Löschen')
        ];
    }
}
