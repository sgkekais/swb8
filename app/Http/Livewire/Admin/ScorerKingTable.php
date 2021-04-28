<?php

namespace App\Http\Livewire\Admin;

use App\Models\ScorerKing;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class ScorerKingTable extends LivewireDatatable
{
    public $model = ScorerKing::class;

    public function columns()
    {
        return [
            NumberColumn::name('season_id')
                ->label('Saison')
                ->searchable(),
            NumberColumn::name('player_id')
                ->label('Spieler')
                ->searchable(),
            Column::callback(['season_id', 'player_id'], function ($season_id, $player_id) {
                return view('admin.includes.table-delete-pivot', ['season_id' => $season_id, 'player_id' => $player_id]);
            })
        ];
    }
}
