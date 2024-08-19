<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class ThirdParty extends Authenticatable
{
    use HasFactory;

    protected $guard = 'thirdparty';
    // Define the table associated with the model
    protected $table = 'thirdparty_login';

    // Define the fillable attributes
    protected $fillable = [
        'email',
        'password',
        'user_id',
        'verification_status',
        'can_view_documents'
    ];

    // Define the relationship with the Candidate model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
