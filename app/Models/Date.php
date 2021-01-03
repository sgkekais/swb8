<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Date extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_type_id',
        'location_id',
        'datetime',
        'title',
        'description',
        'note',
        'published',
        'cancelled',
        'poll_begins',
        'poll_ends',
        'poll_is_open'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'published' => false,
        'cancelled' => false,
        'poll_is_open' => false
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'published' => 'boolean',
        'cancelled' => 'boolean',
        'poll_is_open' => 'boolean',
        'datetime' => 'datetime:Y-m-d\TH:i',
        'poll_begins' => 'date:Y-m-d',
        'poll_ends' => 'date:Y-m-d'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        // 'datetime',
        // 'poll_begins',
        // 'poll_ends'
    ];

    /**
     * The attributes that should be logged.
     *
     * @var array
     */
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    /* SCOPES */

    /**
     * Scope a query to only include dates that are published
     * @param $query
     * @param bool $true
     * @return mixed
     */
    public function scopePublished($query, $true = true) {
        return $query->where('published', $true);
    }

    /**
     * Scope a query to only include dates that are cancelled
     * @param $query
     * @param bool $true
     * @return mixed
     */
    public function scopeCancelled($query, $true = true) {
        return $query->where('cancelled', $true);
    }

    /* RELATIONSHIPS */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dateType()
    {
        return $this->belongsTo('App\Models\DateType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dateOptions()
    {
        return $this->hasMany('App\Models\DateOption');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function match()
    {
        return $this->hasOne('App\Models\Match');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tournament()
    {
        return $this->hasOne('App\Models\Tournament');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function clubs()
    {
        return $this->belongsToMany('App\Models\Club')->withTimestamps();
    }
}
