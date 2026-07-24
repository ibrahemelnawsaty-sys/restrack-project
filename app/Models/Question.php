<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    protected $fillable = [
        'level_id', 'question_ar', 'question_en', 'type',
        'options_ar', 'options_en', 'correct_answer',
        'explanation_ar', 'explanation_en', 'difficulty', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'options_ar' => 'array',
            'options_en' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function getQuestionAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->question_ar : $this->question_en;
    }

    public function getOptionsAttribute(): array
    {
        return app()->getLocale() === 'ar' ? ($this->options_ar ?? []) : ($this->options_en ?? []);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
