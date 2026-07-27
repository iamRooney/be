<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Enquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'enquiry_number',
        'user_id',
        'company_id',
        'product_id',
        'service_id',
        'message',
        'status',
        'priority',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function buyer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    protected static function booted(): void
    {
        static::creating(function ($enquiry) {

            if (!$enquiry->enquiry_number) {

                $lastId = DB::table('enquiries')->max('id') ?? 0;

                $enquiry->enquiry_number = 'ENQ-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function getListingTypeAttribute()
    {
        if ($this->product_id) {
            return 'product';
        }

        if ($this->service_id) {
            return 'service';
        }

        return null;
    }

    public function getListingNameAttribute()
    {
        return $this->product?->name
            ?? $this->service?->name;
    }
}
