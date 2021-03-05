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
        $scorers = Player::whereHas('goals.match.season', function ($query) {
            return $query->where('id', $this->id);
        })->orWhereHas('assists.goal.match.season', function ($query) {
            return $query->where('id', $this->id);
        })->with('goals.match.season', 'assists.goal.match.season')->get();

        // fill scorers with goals, assists and respective totals for sorting
        foreach ($scorers as $scorer)
        {
            $scorer->goals = $scorer->goals->where('match.season.id', $this->id);
            $scorer->total_goals = $scorer->goals->count();
            $scorer->assists = $scorer->assists->where('goal.match.season.id', $this->id);
            $scorer->total_assists = $scorer->assists->count();
            $scorer->scorer_points = $scorer->total_goals + $scorer->total_assists;
        }

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

}
