<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['group', 'key', 'value_ar', 'value_en', 'type'];

    public function getValueAttribute(): ?string
    {
        return app()->getLocale() === 'ar' ? $this->value_ar : $this->value_en;
    }

    public static function get(string $group, string $key, ?string $default = null): ?string
    {
        $setting = static::where('group', $group)->where('key', $key)->first();
        return $setting?->value ?? $default;
    }

    public static function set(string $group, string $key, ?string $valueAr, ?string $valueEn, string $type = 'text'): self
    {
        return static::updateOrCreate(
            ['group' => $group, 'key' => $key],
            ['value_ar' => $valueAr, 'value_en' => $valueEn, 'type' => $type]
        );
    }
}
