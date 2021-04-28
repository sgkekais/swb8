<?php

namespace App\Http\Livewire\Admin;

use App\Models\Player;
use App\Models\ScorerKing;
use App\Models\Season;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class ScorerKingTable extends LivewireDatatable
{
    public $model = ScorerKing::class;

    public function columns()
    {
        return [
            Column::callback('season_id', function ($season_id) {
                $season = Season::find($season_id);
                return ($season->is_ah_season ? "(AH) " : "(HLW) ").$season->title;
            })
                ->label('Saison'),
            Column::callback('player_id', function ($player_id) {
                $player = Player::find($player_id);
                return $player->full_name;
            })
                ->label('Spieler'),
            Column::callback(['season_id', 'player_id'], function ($season_id, $player_id) {
                return view('admin.includes.table-delete-pivot', ['season_id' => $season_id, 'player_id' => $player_id]);
            })
        ];
    }
}
