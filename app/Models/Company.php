<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Company extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guard = 'company';
    protected $table ='companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cname',
        'email',
        'link',
        'mobile',
        'password',
        'image',
        'gstn',
        'companyaddress',
        'ceoname',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'emember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Define the recruiters relationship
    public function recruiters()
    {
        return $this->hasMany(Recruiter::class, 'company_id');
    }
    
}