<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\User;

class Application extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'applications';

    // Define the fillable attributes
    protected $fillable = [
        'job_post_id',
        'name',
        'email',
        'gender',
        'contact',
        'resume',
        'status',
        'round_status',
        'documents',

    ];
    protected $casts = [
        'documents' => 'array',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class, 'job_post_id');
    }
    public function recruiter()
    {
        return $this->belongsTo(Recruiter::class);
    }
    public function documents()
{
    return $this->hasMany(Document::class);
}
    
}
