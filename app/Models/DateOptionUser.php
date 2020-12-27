<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DateOptionUser extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'date_option_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attend'
    ];

    protected $casts = [
        'attend' => 'boolean'
    ];
}
