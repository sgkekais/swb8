<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Traits\LogsActivity;

class Club extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clubs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'name_short', 'name_code', 'logo_url', 'owner', 'ah'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'owner' => false,
        'ah' => false
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'owner' => 'boolean',
        'ah' => 'boolean'
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

    public function scopeOwner($query, $true)
    {
        return $query->where('owner', $true);
    }

    public function scopeAH($query, $true)
    {
        return $query->where('ah', $true);
    }

    /*
     * --------------------------------------------------------------------------
     * METHODS
     * --------------------------------------------------------------------------
     */

    public function logo()
    {
        return $this->logo_url
            ? Storage::disk('club-logos')->url($this->logo_url)
            : Storage::disk('club-logos')->url('default.png');
    }

    /*
     * --------------------------------------------------------------------------
     * RELATIONSHIPS
     * --------------------------------------------------------------------------
     */

    /**
     * A club belongs to many seasons
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function seasons()
    {
        return $this->belongsToMany('App\Models\Season')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function players()
    {
        return $this->belongsToMany('App\Models\Player')
            ->using('App\Models\ClubPlayer')
            ->withPivot(['number', 'player_status_id'])
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function dates()
    {
        return $this->belongsToMany('App\Models\Date')->withTimestamps();
    }

    public function homeMatches()
    {
        return $this->hasMany(Match::class, 'team_home');
    }

    public function awayMatches()
    {
        return $this->hasMany(Match::class, 'team_away');
    }

    public function matches()
    {
        return $this->homeMatches->merge($this->awayMatches);
    }

}
