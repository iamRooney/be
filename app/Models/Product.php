<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'company_id',
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'status',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
