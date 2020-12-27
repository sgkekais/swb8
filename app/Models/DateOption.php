<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class DateOption extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_id',
        'description'
    ];

    /**
     * The attributes that should be logged.
     *
     * @var array
     */
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    /* RELATIONSHIPS */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function date()
    {
        return $this->belongsTo('App\Models\Date');
    }

    /**
     * The users that took part (attend 0 / 1)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User')->withPivot('attend')->withTimestamps();
    }
}
