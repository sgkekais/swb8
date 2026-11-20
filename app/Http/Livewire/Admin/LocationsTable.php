<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Location;
use Arm092\LivewireDatatables\BooleanColumn;
use Arm092\LivewireDatatables\Column;
use Arm092\LivewireDatatables\NumberColumn;

class LocationsTable extends Datatable
{
    public Model|string|null $model = Location::class;

    public bool $exportable = true;

    public function getColumns(): array|Model
    {
        return [
            NumberColumn::name('id')
                ->label('ID'),
            Column::name('name')
                ->label('Name')
                ->searchable()
                ->defaultSort('asc'),
            Column::name('name_short')
                ->label('-Kurz'),
            BooleanColumn::name('is_stadium')
                ->label('Stadion?')
                ->alignCenter()
                ->filterable(),
            Column::name('url')
                ->label('URL'),
            Column::callback(['id'], function ($id) {
                return view('admin.includes.table-actions', ['id' => $id]);
            })
        ];
    }
}
