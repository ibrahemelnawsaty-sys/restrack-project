<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        // Top bar announcement
        Announcement::updateOrCreate(
            ['type' => 'bar', 'title_en' => 'Restrack is live — enroll now'],
            [
                'title_ar' => 'انطلقت منصة ريستراك — سجّل الآن',
                'body_ar' => null,
                'body_en' => null,
                'link_url' => '/register',
                'link_text_ar' => 'سجّل الآن',
                'link_text_en' => 'Enroll now',
                'image' => null,
                'bg_color' => '#af9136',
                'text_color' => '#16264b',
                'is_active' => true,
                'is_dismissible' => true,
                'starts_at' => null,
                'ends_at' => null,
                'display_order' => 1,
            ]
        );

        // Popup announcement
        Announcement::updateOrCreate(
            ['type' => 'popup', 'title_en' => 'Start your research journey'],
            [
                'title_ar' => 'ابدأ رحلتك البحثية',
                'body_ar' => 'التحق ببرنامج المسار البحثي من المبتدئ إلى الخبير في البحث الطبي عبر ثلاثة مستويات متكاملة. سجّل الآن وابدأ التعلّم.',
                'body_en' => 'Join the Research Track program — from beginner to expert in medical research across three integrated levels. Register now and start learning.',
                'link_url' => '/register',
                'link_text_ar' => 'سجّل الآن',
                'link_text_en' => 'Register now',
                'image' => null,
                'bg_color' => '#af9136',
                'text_color' => '#16264b',
                'is_active' => true,
                'is_dismissible' => true,
                'starts_at' => null,
                'ends_at' => null,
                'display_order' => 2,
            ]
        );
    }
}
