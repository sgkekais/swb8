<?php

namespace App\Http\Livewire\Admin;

use App\Models\Tournament;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class TournamentTable extends LivewireDatatable
{
    public $model = Tournament::class;

    public $exportable = true;

    public function columns()
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
