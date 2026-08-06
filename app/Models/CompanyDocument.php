<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'type',
        'original_name',
        'file_path',
        'mime_type',
        'size',
        'status',
        'notes',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    /**
     * Document types a seller can upload, used to verify their legal
     * identity and tax standing. Keep this list in sync with the
     * frontend upload form and the validation rule in the controller.
     */
    public const TYPES = [
        'gst_certificate' => 'GST Certificate',
        'pan_card' => 'PAN Card',
        'business_license' => 'Business License',
        'tax_record' => 'Tax Record',
        'identity_proof' => 'Identity Proof',
        'other' => 'Other',
    ];

    /**
     * The only file types we ever accept, keyed by their real,
     * content-detected MIME type (never trust the client-supplied
     * extension or Content-Type header). The value is the extension
     * *we* choose when storing the file — attacker input never
     * decides what extension lands on disk.
     */
    public const ALLOWED_MIME_TYPES = [
        'application/pdf' => 'pdf',
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(Admin::class, 'reviewed_by');
    }
}
