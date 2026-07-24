<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SurveyResponse extends Model
{
    protected $fillable = [
        'user_id', 'content_quality', 'clarity', 'speaker_quality',
        'tech_quality', 'ease_of_use', 'overall_satisfaction',
        'would_recommend', 'suggestions',
    ];

    protected function casts(): array
    {
        return [
            'would_recommend' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
