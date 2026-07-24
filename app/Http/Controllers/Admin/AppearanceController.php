<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AppearanceController extends Controller
{
    /**
     * Canonical, globally-unique settings the admin can edit here.
     * Bilingual keys expose separate value_ar / value_en inputs.
     * Single keys store the same string in both value_ar and value_en
     * so SiteSetting->value always resolves regardless of locale.
     */
    private function schema(): array
    {
        return [
            'branding' => [
                'tagline' => ['bilingual' => true, 'type' => 'text', 'ar' => 'تعلّم • تطوّر • احترف', 'en' => 'Learn • Grow • Certify'],
            ],
            'footer' => [
                'footer_about' => ['bilingual' => true, 'type' => 'textarea', 'ar' => 'منصة ريستراك التعليمية للبحث الطبي.', 'en' => 'Restrack medical-research e-learning platform.'],
                'footer_email' => ['bilingual' => false, 'type' => 'text', 'default' => 'info@restrack.sa'],
                'footer_phone' => ['bilingual' => false, 'type' => 'text', 'default' => ''],
                'footer_address' => ['bilingual' => true, 'type' => 'text', 'ar' => 'المملكة العربية السعودية', 'en' => 'Saudi Arabia'],
                'newsletter_desc' => ['bilingual' => true, 'type' => 'textarea', 'ar' => 'اشترك ليصلك كل جديد من الدورات والشهادات.', 'en' => 'Subscribe for the latest courses and certificates.'],
            ],
            'social' => [
                'social_twitter' => ['bilingual' => false, 'type' => 'text', 'default' => ''],
                'social_linkedin' => ['bilingual' => false, 'type' => 'text', 'default' => ''],
                'social_instagram' => ['bilingual' => false, 'type' => 'text', 'default' => ''],
                'social_youtube' => ['bilingual' => false, 'type' => 'text', 'default' => ''],
            ],
        ];
    }

    public function index()
    {
        $schema = $this->schema();
        $settings = SiteSetting::whereIn('key', $this->keys($schema))->get()->keyBy('key');

        return view('admin.appearance.index', compact('schema', 'settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'tagline_ar' => ['nullable', 'string', 'max:255'],
            'tagline_en' => ['nullable', 'string', 'max:255'],
            'footer_about_ar' => ['nullable', 'string'],
            'footer_about_en' => ['nullable', 'string'],
            'footer_email' => ['nullable', 'string', 'max:255'],
            'footer_phone' => ['nullable', 'string', 'max:255'],
            'footer_address_ar' => ['nullable', 'string', 'max:255'],
            'footer_address_en' => ['nullable', 'string', 'max:255'],
            'newsletter_desc_ar' => ['nullable', 'string'],
            'newsletter_desc_en' => ['nullable', 'string'],
            'social_twitter' => ['nullable', 'url'],
            'social_linkedin' => ['nullable', 'url'],
            'social_instagram' => ['nullable', 'url'],
            'social_youtube' => ['nullable', 'url'],
        ]);

        foreach ($this->schema() as $group => $fields) {
            foreach ($fields as $key => $meta) {
                if (! empty($meta['bilingual'])) {
                    $valueAr = $validated[$key.'_ar'] ?? null;
                    $valueEn = $validated[$key.'_en'] ?? null;
                } else {
                    // Single-value key: write the same string to both locales.
                    $value = $validated[$key] ?? null;
                    $valueAr = $value;
                    $valueEn = $value;
                }

                SiteSetting::set($group, $key, $valueAr, $valueEn, $meta['type']);
            }
        }

        return back()->with('success', __('messages.settings_updated'));
    }

    private function keys(array $schema): array
    {
        $keys = [];
        foreach ($schema as $fields) {
            $keys = array_merge($keys, array_keys($fields));
        }

        return $keys;
    }
}
