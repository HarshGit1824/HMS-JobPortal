<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Experience extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'role',
        'emp_type',
        'company',
        'location',
        'location_type',
        'start_date',
        'end_date',
        'description',
    ];

    /**
     * Get the user that owns the experience.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
