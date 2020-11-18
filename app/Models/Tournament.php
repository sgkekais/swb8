<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Tournament extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tournaments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_id',
        'title',
        'description',
        'place'
    ];

    /**
     * The attributes that should be logged.
     *
     * @var array
     */
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function date() {
        return $this->belongsTo('App\Models\Date');
    }

}
