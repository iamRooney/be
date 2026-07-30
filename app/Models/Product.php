<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

        'company_id',

        'category_id',

        'name',

        'slug',

        'short_description',

        'description',

        'image',

        'gallery',

        'price',

        'unit',

        'status',

        'featured',

        'views'

    ];

    protected $casts = [

        'gallery' => 'array',

        'featured' => 'boolean'

    ];

    protected $appends = [
        'image_url',
    ];

    public function getImageUrlAttribute(): ?string
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : null;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {

            $product->slug = Str::slug($product->name);
        });
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function enquiries()
    {
        return $this->hasMany(Enquiry::class);
    }
}
