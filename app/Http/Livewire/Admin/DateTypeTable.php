<?php

namespace App\Http\Livewire\Admin;

use App\Models\DateType;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class DateTypeTable extends LivewireDatatable
{
    public $model = DateType::class;

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('asc'),
            Column::name('description')
                ->label('Beschreibung')
                ->searchable(),
            Column::callback(['id'], function ($id) {
                return view('admin.includes.table-actions', ['id' => $id]);
            })
        ];
    }
}
