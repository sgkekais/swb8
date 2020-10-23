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

    public $exportable = true;

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID'),
            Column::name('name')
                ->label('Name')
                ->searchable()
                ->editable()
                ->defaultSort('asc'),
            Column::name('name_short')
                ->label('-Kurz')
                ->editable(),
            Column::name('name_code')
                ->label('-Code')
                ->editable(),
            Column::name('logo_url')
                ->label('Logo'),
            BooleanColumn::name('owner')
                ->label('Besitzer?')
                ->editable(),
            BooleanColumn::name('ah')
                ->label('AH')
                ->editable(),
            Column::delete()
                ->label('Löschen')

        ];
    }
}
