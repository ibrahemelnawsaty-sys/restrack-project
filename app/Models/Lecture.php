<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lecture extends Model
{
    protected $fillable = [
        'level_id', 'speaker_id', 'order', 'title_ar', 'title_en',
        'description_ar', 'description_en', 'video_url', 'video_provider',
        'duration_minutes', 'thumbnail', 'resources', 'is_published', 'is_free_preview',
        'video_disk', 'video_path', 'video_status', 'video_mime', 'video_size',
        'video_original_name', 'video_duration_seconds', 'hls_path', 'hls_key_path',
    ];

    protected function casts(): array
    {
        return [
            'resources' => 'array',
            'is_published' => 'boolean',
            'is_free_preview' => 'boolean',
            'video_size' => 'integer',
            'video_duration_seconds' => 'integer',
        ];
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function speaker(): BelongsTo
    {
        return $this->belongsTo(Speaker::class);
    }

    public function progress(): HasMany
    {
        return $this->hasMany(StudentProgress::class);
    }

    public function getTitleAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->title_ar : $this->title_en;
    }

    public function getDescriptionAttribute(): ?string
    {
        return app()->getLocale() === 'ar' ? $this->description_ar : $this->description_en;
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    /**
     * True when this lecture serves a self-hosted (uploaded) video rather than an
     * external embed. Self-hosted is the target model — external providers are legacy.
     */
    public function isSelfHosted(): bool
    {
        return $this->video_provider === 'custom';
    }

    /** Self-hosted asset has finished processing and has something playable. */
    public function videoIsReady(): bool
    {
        return $this->isSelfHosted()
            && $this->video_status === 'ready'
            && ($this->hls_path !== null || $this->video_path !== null);
    }

    /** Prefer encrypted HLS when it was packaged; otherwise fall back to the protected file. */
    public function hasEncryptedHls(): bool
    {
        return $this->hls_path !== null && $this->hls_key_path !== null;
    }
}
