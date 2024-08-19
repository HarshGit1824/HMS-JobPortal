<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    use HasFactory;
    protected $fillable = ['name','status'];


    public function jobPosts()
    {
        return $this->hasMany(JobPost::class);
    }

}
