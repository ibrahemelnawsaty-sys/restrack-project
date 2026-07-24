<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'question_ar', 'question_en', 'answer_ar', 'answer_en',
        'category', 'display_order', 'is_visible',
    ];

    protected function casts(): array
    {
        return [
            'is_visible' => 'boolean',
        ];
    }

    public function getQuestionAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->question_ar : $this->question_en;
    }

    public function getAnswerAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->answer_ar : $this->answer_en;
    }

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true)->orderBy('display_order');
    }
}
