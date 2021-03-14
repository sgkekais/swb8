<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Match extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'matches';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_id',
        'match_type_id',
        'season_id',
        'matchweek',
        'team_home',
        'team_away',
        'goals_home',
        'goals_home_ht',
        'goals_home_pen',
        'goals_home_rated',
        'goals_away',
        'goals_away_ht',
        'goals_away_pen',
        'goals_away_rated',
        'match_details',
        'rescheduled_to_fixture_id',
        'rescheduled_by_team',
        'reschedule_reason',
        'published',
        'cancelled'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'published' => false,
        'cancelled' => false
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'published' => 'boolean',
        'cancelled' => 'boolean'
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

    public function scopePlayedOrRated()
    {

    }

    /*
     * --------------------------------------------------------------------------
     * METHODS
     * --------------------------------------------------------------------------
     */

    /**
     * Check if match has been played
     * @return bool
     */
    public function isPlayed()
    {
        if (isset($this->goals_home) && isset($this->goals_away))
        {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if the match has been rated
     * @return bool
     */
    public function isRated()
    {
        if (isset($this->goals_home_rated) && isset($this->goals_away_rated))
        {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if the match has been rated or played
     * @return bool
     */
    public function isPlayedOrRated()
    {
        if (isset($this->goals_home_rated) && isset($this->goals_away_rated)) {
            return true;
        } elseif (isset($this->goals_home) && isset($this->goals_away)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if we won this match
     * @return bool
     */
    public function isWon()
    {
        if ($this->teamHome->owner && ($this->goals_home > $this->goals_away || $this->goals_home_rated > $this->goals_away_rated))
        {
            return true;
        }
        elseif ($this->teamAway->owner && ($this->goals_home < $this->goals_away || $this->goals_home_rated < $this->goals_away_rated))
        {
            return true;
        }
        return false;
    }

    /**
     * Check if we lost this match
     * @return bool
     */
    public function isLost()
    {
        if ($this->teamHome->owner && ($this->goals_home < $this->goals_away || $this->goals_home_rated < $this->goals_away_rated))
        {
            return true;
        }
        elseif ($this->teamAway->owner && ($this->goals_home > $this->goals_away || $this->goals_home_rated > $this->goals_away_rated))
        {
            return true;
        }
        return false;
    }

    /**
     * Check if the match had penalties
     * @return bool
     */
    public function isPenalties()
    {
        if (isset($this->goals_home_pen) && isset($this->goals_away_pen))
        {
            return true;
        } else {
            return false;
        }
    }

    /*
     * --------------------------------------------------------------------------
     * RELATIONSHIPS
     * --------------------------------------------------------------------------
     */

    /**
     * A match belongs to a Date
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function date()
    {
        return $this->belongsTo('App\Models\Date');
    }

    /**
     * A match belongs to a Season
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function season()
    {
        return $this->belongsTo('App\Models\Season');
    }

    /**
     * A match belongs to a MatchType
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function matchType()
    {
        return $this->belongsTo('App\Models\MatchType');
    }

    /**
     * A match belongs to a team (home)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teamHome()
    {
        return $this->belongsTo('App\Models\Club', 'team_home');
    }

    /**
     * A match belongs to a team (away)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teamAway()
    {
        return $this->belongsTo('App\Models\Club', 'team_away');
    }

    /**
     * A match has many goals
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goals()
    {
        return $this->hasMany('App\Models\Goal');
    }

    public function assists()
    {
        return $this->hasManyThrough('App\Models\Assist', 'App\Models\Goal');
    }

    /**
     * A match has many cards
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cards()
    {
        return $this->hasMany('App\Models\Card');
    }

    // TODO: rescheduled
}
