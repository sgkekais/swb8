<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClubPlayer extends Pivot
{
    //
    protected $fillable = [
        'number',
        'player_status_id'
    ];

    public function playerStatus()
    {
        return $this->belongsTo('App\Models\PlayerStatus');
    }
}
