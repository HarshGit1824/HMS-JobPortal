<?php


// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class JobPost extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'recruiter_id', 'position_name', 'vacancy', 'start_date', 'end_date', 'salary_range', 'location'
//     ];

//     public function recruiter()
//     {
//         return $this->belongsTo(Recruiter::class);
//     }

//     public function JobType(){
//         return $this->belongsTo(JobType::class);
//     }

//     public function Category(){
//         return $this->belongsTo(Category::class);
//     }
// }

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'recruiter_id', 'position_name', 'vacancy', 'start_date', 'end_date', 'salary', 'location', 'status', 'isFeatured', 'job_type'
    ];

    public function recruiter()
    {
        return $this->belongsTo(Recruiter::class);
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class, 'job_type', 'id');
    }

    public function category()
    {
        // return $this->belongsTo(Category::class);
        return $this->belongsTo(Category::class, 'category', 'id');
    }
    public function category1()
    {
        return $this->belongsTo(Category::class, 'category', 'name');
    }
    
    public function getJobTypeName()
    {
        return $this->jobType->name ?? 'Default Job Type';
    }
    

    public function applications() {
        return $this->hasMany(Application::class);
    }
}