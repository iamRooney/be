<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Requirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'requirement_number',
        'user_id',
        'category_id',
        'title',
        'quantity',
        'unit',
        'alternate_phone',
        'status',
        'accepted_by_company_id',
        'accepted_at',
    ];

    protected $casts = [
        'accepted_at' => 'datetime',
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function acceptedByCompany()
    {
        return $this->belongsTo(Company::class, 'accepted_by_company_id');
    }

    protected static function booted(): void
    {
        static::creating(function ($requirement) {

            if (!$requirement->requirement_number) {

                $lastId = DB::table('requirements')->max('id') ?? 0;

                $requirement->requirement_number = 'RFQ-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
