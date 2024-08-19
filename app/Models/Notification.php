<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'recruiter_email',
        'applicant_email',
        'message',
    ];
}
