<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\PlayerStatus;
use Arm092\LivewireDatatables\BooleanColumn;
use Arm092\LivewireDatatables\Column;
use Arm092\LivewireDatatables\NumberColumn;

class PlayerStatusTable extends Datatable
{
    public Model|string|null $model = PlayerStatus::class;

    public function getColumns(): array|Model
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('desc'),
            Column::name('description')
                ->label('Beschreibung')
                ->searchable(),
            BooleanColumn::name('can_play')
                ->label('Kann spielen?'),
            BooleanColumn::name('display_in_polls')
                ->label('Anzeige in Umfrage?'),
            BooleanColumn::name('display_in_squad')
                ->label('Anzeige in Kader?'),
            NumberColumn::name('sort_order')
                ->label('Anzeigereihenfolge'),
            Column::callback(['id'], function ($id) {
                return view('admin.includes.table-actions', ['id' => $id]);
            })
        ];
    }
}
