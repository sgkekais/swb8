<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Club;
use App\Models\Season;
use Arm092\LivewireDatatables\BooleanColumn;
use Arm092\LivewireDatatables\Column;
use Arm092\LivewireDatatables\NumberColumn;

class SeasonTable extends Datatable
{
    public Model|string|null $model = Season::class;

    public function getColumns(): array|Model
    {
        return [
            NumberColumn::name('id')
                ->label('ID'),
            NumberColumn::name('number')
                ->label('Nr.')
                ->searchable()
                ->defaultSort('desc'),
            Column::name('year')
                ->label('Jahr')
                ->searchable(),
            Column::name('title')
                ->label('Titel')
                ->searchable(),
            Column::name('description')
                ->label('Beschreibung')
                ->truncate(50)
                ->searchable(),
            Column::name('final_position')
                ->label('Platz'),
            Column::name('clubs.name_code')
                ->label('Gültig für')
                ->filterable($this->club_name),
            BooleanColumn::name('is_ah_season')
                ->label('AH-Saison?')
                ->filterable(),
            Column::callback(['id'], function ($id) {
                return view('admin.includes.table-actions', ['id' => $id]);
            })
        ];
    }

    // get date type descriptions to filter
    public function getClubNameProperty()
    {
        return Club::owner(true)->pluck('name_code');
    }
}
