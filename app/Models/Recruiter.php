<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Recruiter extends Authenticatable
{
    use HasFactory;
    protected $guard = 'recruiter';
    protected $table ='recruiters';

    protected $fillable = [
        'company_id', 'name', 'department', 'obile', 'email', 'password'
    ];

    public function jobPosts()
    {
        return $this->hasMany(JobPost::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function rounds()
    {
        return $this->hasMany(Rounds::class);
    }
    
}