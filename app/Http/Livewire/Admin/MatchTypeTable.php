<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\MatchType;
use Arm092\LivewireDatatables\BooleanColumn;
use Arm092\LivewireDatatables\Column;
use Arm092\LivewireDatatables\NumberColumn;

class MatchTypeTable extends Datatable
{
    public Model|string|null $model = MatchType::class;

    public function getColumns(): array|Model
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('desc'),
            Column::name('description')
                ->label('Beschreibung')
                ->searchable(),
            Column::name('description_short')
                ->label('Abk.')
                ->searchable(),
            BooleanColumn::name('is_point_match')
                ->label('Punktspiel?'),
            Column::callback(['id'], function ($id) {
                return view('admin.includes.table-actions', ['id' => $id]);
            })
        ];
    }
}
