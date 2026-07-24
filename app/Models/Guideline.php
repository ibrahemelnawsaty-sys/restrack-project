<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guideline extends Model
{
    protected $fillable = [
        'name', 'logo', 'url', 'type', 'display_order', 'is_visible',
    ];

    protected function casts(): array
    {
        return [
            'is_visible' => 'boolean',
        ];
    }

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true)->orderBy('display_order');
    }
}
