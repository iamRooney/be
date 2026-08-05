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

    protected $appends = [
        'profile_image_url',
    ];

    public function getProfileImageUrlAttribute(): ?string
    {
        return $this->profile_image
            ? asset('storage/' . $this->profile_image)
            : null;
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

    /** Companies this buyer has liked/saved from the homepage. */
    public function savedCompanies()
    {
        return $this->belongsToMany(Company::class, 'saved_companies')->withTimestamps();
    }

    /** Products this buyer has viewed, most-recent-touch per product (see RecentlyViewedController). */
    public function recentlyViewedProducts()
    {
        return $this->hasMany(RecentlyViewedProduct::class);
    }

    /** Requirements ("Post Your Requirement" / RFQs) this buyer has posted. */
    public function requirements()
    {
        return $this->hasMany(Requirement::class);
    }
}
