<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Goal;
use App\Models\Player;
use Arm092\LivewireDatatables\BooleanColumn;
use Arm092\LivewireDatatables\Column;
use Arm092\LivewireDatatables\NumberColumn;

class GoalTable extends Datatable
{
    public Model|string|null $model = Goal::class;

    public bool $exportable = true;

    public ?int $perPage = 15;

    public function getColumns(): array|Model
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('desc'),
            Column::callback('match_id', function ($match_id) {
                return "<a href='".route('admin.matches', ['match_id' => $match_id])."' class='text-blue-700'>".$match_id."</a>";
            })->label('Match-ID'),
            Column::name('player_id')
                ->label('Spieler_ID')
                ->filterable($this->player_ids),
            Column::callback(['player_id'], function ($id) {
                return Player::find($id)->full_name_short;
            })
                ->label('Spieler')
                ->searchable(),
            Column::name('score')
                ->label('Ergebnis')
                ->alignCenter()
                ->filterable(),
            BooleanColumn::name('penalty')
                ->label('11m')
                ->alignCenter()
                ->filterable()
        ];
    }

    public function getPlayerIdsProperty()
    {
        return Player::all()->pluck('id');
    }
}
