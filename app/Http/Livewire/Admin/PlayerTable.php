<?php

namespace App\Http\Livewire\Admin;

use App\Models\Player;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class PlayerTable extends LivewireDatatable
{
    public $model = Player::class;

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('desc'),
            Column::name('player_status_id')
                ->label('Status'),
            Column::name('user_id')
                ->label('User'),
            Column::name('first_name')
                ->label('Vorname')
                ->searchable(),
            Column::name('last_name')
                ->label('Nachname')
                ->searchable(),
            Column::name('nickname')
                ->label('Spitzname')
                ->searchable(),
            DateColumn::name('dob')
                ->label('Geb.datum'),
            DateColumn::name('joined')
                ->label('Eintritt'),
            DateColumn::name('left')
                ->label('Austritt'),
            Column::name('public_note')
                ->label('Notiz (ext.)')
                ->truncate(),
            Column::name('internal_note')
                ->label('Notiz (int.)')
                ->truncate(),
            Column::callback(['id'], function ($id) {
                return view('admin.includes.table-actions', ['id' => $id]);
            })
        ];
    }
}
