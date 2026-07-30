<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'description',
        'status'
    ];

    protected $appends = ['icon_url'];

    public function getIconUrlAttribute(): ?string
    {
        return $this->icon
            ? url('uploads/categories/' . $this->icon)
            : null;
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
