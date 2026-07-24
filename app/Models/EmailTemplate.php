<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $fillable = [
        'slug', 'name', 'subject_ar', 'subject_en',
        'body_ar', 'body_en', 'variables', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'variables' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function getSubjectAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->subject_ar : $this->subject_en;
    }

    public function getBodyAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->body_ar : $this->body_en;
    }
}
