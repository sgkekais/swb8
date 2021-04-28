<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Season extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_ah_season', 'number', 'title', 'description',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'is_ah_season' => false,
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_ah_season' => 'boolean',
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
    * SCOPES
    * --------------------------------------------------------------------------
    */

    public function scopeAHSeason($query, $true)
    {
        return $query->where('is_ah_season',$true);
    }

    public function scopeCurrent($query, $ah = false)
    {
        $max = Season::where('is_ah_season', $ah)->max('number');
        return $query->where('is_ah_season', $ah)->where('number', $max);
    }

    /*
    * --------------------------------------------------------------------------
    * METHODS
    * --------------------------------------------------------------------------
    */

    /**
     * Return a collection of scorers (player with goals & assists + total_goals, total_assists, scorer_points for the given season
     * @return mixed
     */
    public function scorers()
    {
        $players = Player::whereHas('goals.match', function ($query) {
            return $query->where('season_id', $this->id);
        })->orWhereHas('assists.goal.match', function ($query) {
            return $query->where('season_id', $this->id);
        })->get();

        $scorers = $players->map(function ($player) {
            $player->total_goals = $player->goals()->whereHas('match', function ($query) { return $query->where('season_id', $this->id); })->count();
            $player->total_assists = $player->assists()->whereHas('goal.match', function ($query) { return $query->where('season_id', $this->id); })->count();
            $player->scorer_points = $player->total_goals + $player->total_assists;

            return $player;
        });

        return $scorers;
    }

    /*
     * --------------------------------------------------------------------------
     * RELATIONSHIPS
     * --------------------------------------------------------------------------
     */

    /**
     * A season has many clubs
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function clubs()
    {
        return $this->belongsToMany('App\Models\Club')->withTimestamps();;
    }

    public function matches()
    {
        return $this->hasMany('App\Models\Match');
    }

    public function goals()
    {
        return $this->hasManyThrough('App\Models\Goal', 'App\Models\Match');
    }

    public function cards()
    {
        return $this->hasManyThrough('App\Models\Card', 'App\Models\Match');
    }

    public function scorerKings()
    {
        return $this->belongsToMany('App\Models\Player', 'scorer_kings')->withTimestamps()->using(ScorerKing::class);
    }

}
