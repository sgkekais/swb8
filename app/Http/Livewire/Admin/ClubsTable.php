<?php

namespace App\Http\Livewire\Admin;

use App\Models\Club;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class ClubsTable extends LivewireDatatable
{
    public $model = Club::class;

    // public $exportable = true;

  /*  public function builder()
    {
        return Club::withCount('players');
    }*/

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID'),
            Column::name('name')
                ->label('Name')
                ->searchable(),
            Column::name('name_short')
                ->label('-Kurz'),
            Column::name('name_code')
                ->label('-Code'),
            Column::name('logo_url')
                ->label('Logo'),
            BooleanColumn::name('owner')
                ->label('Besitzer?')->alignCenter()
                ->defaultSort('desc'),
            BooleanColumn::name('ah')
                ->label('AH')->alignCenter(),
            Column::name('players.id:count')
                ->label('Spieler'),
            Column::callback(['id'], function ($id) {
                return view('admin.includes.table-actions', ['id' => $id]);
            })
        ];
    }
}
