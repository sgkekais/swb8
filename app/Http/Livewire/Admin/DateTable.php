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
    // public $model = Date::class;

    public function builder()
    {
        return $dates = Date::query()->with('dateType');
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('desc'),
            Column::callback('dateType.id', function ($datetype_id) {
                switch($datetype_id) {
                    case 1: return '<i class="fas fa-fw fa-poll"></i>';
                    case 2: return '<i class="far fa-fw fa-futbol"></i>';
                    case 3: return '<i class="fas fa-fw fa-trophy"></i>';
                    case 4: return '<i class="fas fa-fw fa-glass-cheers"></i>';
                }
            }),
            NumberColumn::name('datetype.description')
                ->label('Date Type ID'),
            NumberColumn::name('location.name')
                ->label('Location ID'),
            DateColumn::name('datetime')
                ->label('date time')
                ->format('d.m.Y H:s'),
            Column::callback(['id'], function ($id) {
                return view('admin.includes.table-actions', ['id' => $id]);
            })
        ];
    }
}
