<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'application_id',
        'photo_id_proof',
        'address_proof',
        'degree_certificate',
        'other_document',
    ];

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
   
}
