<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Arm092\LivewireDatatables\BooleanColumn;
use Arm092\LivewireDatatables\Column;
use Arm092\LivewireDatatables\DateColumn;
use Arm092\LivewireDatatables\NumberColumn;

class UserTable extends Datatable
{
    public Model|string|null $model = User::class;

    public function getColumns(): array|Model
    {
        return [
            /*Column::callback(['id'], function ($id) {
                return view('admin.includes.table-actions', ['id' => $id]);
            }),*/
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('desc'),
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
        ];
    }
}
