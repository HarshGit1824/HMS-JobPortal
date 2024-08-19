<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rounds extends Model
{
    use HasFactory;
    protected $table='rounds';
    protected $fillable = ['name', 'description', 'recruiter_id'];

    public function recruiter()
    {
        return $this->belongsTo(Recruiter::class);
    }
}
