<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
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
        'internal_note',
        'is_public'
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
        'is_public' => 'boolean'
    ];

    /**
     * The attributes that should be logged.
     *
     * @var array
     */
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    /*
     * --------------------------------------------------------------------------
     * ACCESSORS
     * --------------------------------------------------------------------------
     */

    public function getFullNameAttribute()
    {
        return $this->first_name." ".$this->last_name;
    }

    public function getFullNameShortAttribute()
    {
        return $this->first_name." ".Str::limit($this->last_name, 1, '.');
    }

    public function getNameAttribute()
    {
        if ($this->is_public)
        {
            return $this->nickname ?: $this->full_name;
        }
        return "Anonym";
    }

    public function getNameShortAttribute()
    {
        if ($this->is_public)
        {
            return $this->nickname ?: $this->full_name_short;
        }
        return "Anonym";
    }

    /*
     * --------------------------------------------------------------------------
     * SCOPES
     * --------------------------------------------------------------------------
     */

    public function scopeIsPublic($query, $true)
    {
        return $query->where('is_public', $true);
    }

    /*
     * --------------------------------------------------------------------------
     * RELATIONSHIPS
     * --------------------------------------------------------------------------
     */

    /**
     * A player can be linked to a user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function dateOptions()
    {
        return $this->hasManyThrough('App\Models\DateOptionUser', 'App\Models\User');
    }

    /**
     * A player belongs to one or many clubs
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function clubs()
    {
        return $this->belongsToMany('App\Models\Club')->withPivot('number')->withTimestamps();
    }

    /**
     * A player has a 'status' (e.g. active, passive, injured, ...)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function playerStatus()
    {
        return $this->belongsTo('App\Models\PlayerStatus');
    }

    /**
     * A player has one or many goals
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goals()
    {
        return $this->hasMany('App\Models\Goal');
    }

    /**
     * A player has one or many assists
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assists()
    {
        return $this->hasMany('App\Models\Assist');
    }

    /**
     * A player has one or many cards
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cards()
    {
        return $this->hasMany('App\Models\Card');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function scorerTitles()
    {
        return $this->belongsToMany('App\Models\Season', 'scorer_kings')->withTimestamps()->using(ScorerKing::class);
    }

}
