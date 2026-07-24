<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Level extends Model
{
    protected $fillable = [
        'order', 'title_ar', 'title_en', 'description_ar', 'description_en',
        'learning_outcomes_ar', 'learning_outcomes_en', 'topics_ar', 'topics_en',
        'passing_score', 'exam_questions_count', 'is_published', 'icon', 'color',
    ];

    protected function casts(): array
    {
        return [
            'learning_outcomes_ar' => 'array',
            'learning_outcomes_en' => 'array',
            'topics_ar' => 'array',
            'topics_en' => 'array',
            'is_published' => 'boolean',
        ];
    }

    public function lectures(): HasMany
    {
        return $this->hasMany(Lecture::class)->orderBy('order');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function examAttempts(): HasMany
    {
        return $this->hasMany(ExamAttempt::class);
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
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
}
