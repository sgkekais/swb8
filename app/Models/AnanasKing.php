<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\Activitylog\Traits\LogsActivity;

class AnanasKing extends Pivot
{
    use LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ananas_kings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'player_id',
        'season_id'
    ];

    /**
     * The attributes that should be logged.
     *
     * @var array
     */
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
}
