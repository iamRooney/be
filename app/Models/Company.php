<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [

        'country_id',
        'state_id',
        'city_id',

        'name',
        'slug',
        'logo',

        'email',
        'phone',

        'website',

        'gst_number',

        'description',

        'address',

        'years_in_business',

        'annual_turnover',

        'staff_count',

        'response_rate',

        'verified',

        'status'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function enquiries()
    {
        return $this->hasMany(Enquiry::class);
    }
}
