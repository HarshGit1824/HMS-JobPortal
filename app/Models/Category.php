<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'recruiter_id'];

    public function recruiter()
    {
        return $this->belongsTo(Recruiter::class);
    }
    public function jobPosts()
    {
        return $this->hasMany(JobPost::class);
    }
    public function jobPost()
    {
        return $this->hasMany(JobPost::class, 'category', 'name');
    }
}
