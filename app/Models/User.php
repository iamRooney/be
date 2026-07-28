<?php

namespace App\Models;

use App\Models\Company;
use App\Models\Enquiry;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * Mass Assignable
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'role',
        'is_profile_completed',
        'profile_image',
        'password',
        'otp',
        'otp_expires_at',
        'otp_verified_at',
        'status',
    ];

    /**
     * Hidden Attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp',
    ];

    /**
     * Attribute Casting
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'otp_expires_at' => 'datetime',
            'otp_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => 'boolean',
            'is_profile_completed' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function enquiries()
    {
        return $this->hasMany(Enquiry::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }
}
