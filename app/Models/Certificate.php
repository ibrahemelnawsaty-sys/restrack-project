<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
{
    protected $fillable = [
        'user_id', 'level_id', 'certificate_number', 'score',
        'type', 'file_path', 'issued_at', 'verified_count',
    ];

    protected function casts(): array
    {
        return [
            'score' => 'decimal:2',
            'issued_at' => 'datetime',
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

    public static function generateNumber(): string
    {
        return 'RST-' . date('Y') . '-' . strtoupper(substr(uniqid(), -8));
    }
}
