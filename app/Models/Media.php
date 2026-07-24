<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends Model
{
    protected $fillable = [
        'filename', 'original_name', 'mime_type', 'size',
        'path', 'alt_text_ar', 'alt_text_en', 'folder', 'uploaded_by',
    ];

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function getAltTextAttribute(): ?string
    {
        return app()->getLocale() === 'ar' ? $this->alt_text_ar : $this->alt_text_en;
    }
}
