<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'project_name',
        'start_date',
        'end_date',
        'technologies',
        'description',
    ];
}
