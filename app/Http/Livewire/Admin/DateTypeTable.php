<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\DateType;
use Arm092\LivewireDatatables\Column;
use Arm092\LivewireDatatables\NumberColumn;

class DateTypeTable extends Datatable
{
    public Model|string|null $model = DateType::class;

    public function getColumns(): array|Model
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
