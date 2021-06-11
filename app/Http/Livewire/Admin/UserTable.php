<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class UserTable extends LivewireDatatable
{
    public $model = User::class;

    public function columns()
    {
        return [

            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('asc'),
            Column::name('name')
                ->label('Name')
                ->searchable(),
            Column::name('email')
                ->label('EMail')
                ->searchable(),
            BooleanColumn::name('is_admin')
                ->label('Admin')
                ->editable(),
            BooleanColumn::name('banned')
                ->label('Gebannt')
                ->editable(),
//            Column::callback(['id'], function ($id) {
//                return view('admin.includes.table-actions', ['id' => $id]);
//            }),
        ];
    }
}
