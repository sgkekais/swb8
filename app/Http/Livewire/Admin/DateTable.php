<?php

namespace App\Http\Livewire\Admin;

use App\Models\Date;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class DateTable extends LivewireDatatable
{
    public $model = Date::class;

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('desc'),
            NumberColumn::name('date_type_id')
                ->label('Date Type ID'),
            NumberColumn::name('location_id')
                ->label('Location ID'),
            DateColumn::name('date_time')
                ->label('date time'),
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
