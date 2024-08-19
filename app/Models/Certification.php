<?php

// app/Models/Certification.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'certification_name',
        'institution',
        'date_obtained',
        'document',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}