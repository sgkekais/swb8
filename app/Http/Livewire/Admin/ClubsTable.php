<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Club;
use Arm092\LivewireDatatables\BooleanColumn;
use Arm092\LivewireDatatables\Column;
use Arm092\LivewireDatatables\NumberColumn;

class ClubsTable extends Datatable
{
    public Model|string|null $model = Club::class;

    // public bool $exportable = true;

  /*  public function builder(): Builder
    {
        return Club::withCount('players');
    }*/

    public function getColumns(): array|Model
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->searchable(),
            Column::name('name')
                ->label('Name')
                ->searchable(),
            Column::name('name_short')
                ->label('-Kurz')
                ->searchable(),
            Column::name('name_code')
                ->label('-Code')
                ->searchable(),
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
