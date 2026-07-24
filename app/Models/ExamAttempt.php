<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamAttempt extends Model
{
    protected $fillable = [
        'user_id', 'level_id', 'score', 'total_questions', 'correct_answers',
        'passed', 'time_spent_seconds', 'questions_snapshot', 'started_at', 'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'score' => 'decimal:2',
            'passed' => 'boolean',
            'questions_snapshot' => 'array',
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function scopePassed($query)
    {
        return $query->where('passed', true);
    }
}
