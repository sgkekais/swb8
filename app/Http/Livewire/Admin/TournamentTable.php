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
            NumberColumn::name('date_id')
                ->label('Termin')
                ->searchable(),
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

        ];
    }
}
