<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tournament;
use Arm092\LivewireDatatables\Column;
use Arm092\LivewireDatatables\NumberColumn;

class TournamentTable extends Datatable
{
    public Model|string|null $model = Tournament::class;

    public bool $exportable = true;

    public function getColumns(): array|Model
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('desc'),
            Column::callback('date_id', function ($date_id) {
                return "<a href='".route('admin.dates', ['date_id' => $date_id])."' class='text-primary-600 underline'>".$date_id."</a>";
            })->label('Termin-ID'),
            Column::name('date.datetime'),
            Column::name('title')
                ->label('Titel')
                ->searchable(),
            Column::name('description')
                ->label('Beschreibung')
                ->searchable()
                ->truncate(),
            Column::name('place')
                ->label('Platz')
                ->alignCenter(),
            Column::callback(['id'], function ($id) {
                return view('admin.includes.table-actions', ['id' => $id]);
            })
        ];
    }
}
