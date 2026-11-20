<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Card extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cards';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'match_id',
        'player_id',
        'color',
        'note'
    ];

    /**
     * The attributes that should be logged.
     *
     * @var array
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty();
    }

    public function match() {
        return $this->belongsTo('App\Models\Game');
    }

    public function player() {
        return $this->belongsTo('App\Models\Player');
    }
}
