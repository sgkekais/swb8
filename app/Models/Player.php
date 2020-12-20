<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Player extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'players';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'player_status_id',
        'user_id',
        'first_name',
        'last_name',
        'nickname',
        'dob',
        'joined',
        'left',
        'public_note',
        'internal_note'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'joined' => 'date:Y-m-d',
        'left' => 'date:Y-m-d',
        'dob' => 'date:Y-m-d',
    ];

    /**
     * The attributes that should be logged.
     *
     * @var array
     */
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function playerStatus() {
        return $this->belongsTo('App\Models\PlayerStatus');
    }

    public function goals() {
        return $this->hasMany('App\Models\Goal');
    }

    public function assists() {
        return $this->hasMany('App\Models\Assist');
    }

    public function cards() {
        return $this->hasMany('App\Model\Card');
    }
}
