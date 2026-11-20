<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Assist;
use Arm092\LivewireDatatables\Column;
use Arm092\LivewireDatatables\NumberColumn;

class AssistTable extends Datatable
{
    public Model|string|null $model = Assist::class;

    public bool $exportable = true;

    public function getColumns(): array|Model
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('desc'),
            NumberColumn::name('goal_id')
                ->label('Tor')
                ->searchable()
                ->filterable(),
            NumberColumn::name('player_id')
                ->label('Spieler')
                ->filterable()
                ->searchable()
        ];
    }
}
