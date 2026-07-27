<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [

        'company_id',

        'category_id',

        'name',

        'slug',

        'image',

        'short_description',

        'description',

        'starting_price',

        'service_area',

        'experience',

        'availability',

        'featured',

        'status',

    ];

    protected $casts = [

        'featured' => 'boolean',

        'starting_price' => 'decimal:2',

    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
