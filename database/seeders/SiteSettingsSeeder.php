<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value_ar' => 'ريسترك', 'value_en' => 'Restrack', 'group' => 'general', 'type' => 'text'],
            ['key' => 'site_email', 'value_ar' => 'info@restrack.sa', 'value_en' => 'info@restrack.sa', 'group' => 'general', 'type' => 'text'],
            ['key' => 'site_phone', 'value_ar' => '+966500000000', 'value_en' => '+966500000000', 'group' => 'general', 'type' => 'text'],
            ['key' => 'price', 'value_ar' => '899', 'value_en' => '899', 'group' => 'payment', 'type' => 'text'],
            ['key' => 'currency', 'value_ar' => 'ريال', 'value_en' => 'SAR', 'group' => 'payment', 'type' => 'text'],
            ['key' => 'payment_gateway', 'value_ar' => 'moyasar', 'value_en' => 'moyasar', 'group' => 'payment', 'type' => 'text'],
            ['key' => 'twitter', 'value_ar' => 'https://twitter.com/restrack', 'value_en' => 'https://twitter.com/restrack', 'group' => 'social', 'type' => 'text'],
            ['key' => 'instagram', 'value_ar' => 'https://instagram.com/restrack', 'value_en' => 'https://instagram.com/restrack', 'group' => 'social', 'type' => 'text'],
            ['key' => 'whatsapp', 'value_ar' => '+966500000000', 'value_en' => '+966500000000', 'group' => 'social', 'type' => 'text'],
            ['key' => 'maintenance_mode', 'value_ar' => '0', 'value_en' => '0', 'group' => 'general', 'type' => 'boolean'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::firstOrCreate(
                ['key' => $setting['key'], 'group' => $setting['group']],
                $setting
            );
        }
    }
}
