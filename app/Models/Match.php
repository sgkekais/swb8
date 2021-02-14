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
     * METHODS
     * --------------------------------------------------------------------------
     */

    // TODO: result() method to return result (normal, penalties, rated, cancelled)

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
