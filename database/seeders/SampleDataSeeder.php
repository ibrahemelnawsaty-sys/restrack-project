<?php

namespace Database\Seeders;

use App\Models\Speaker;
use App\Models\Level;
use App\Models\Lecture;
use App\Models\Question;
use App\Models\Faq;
use App\Models\Guideline;
use App\Models\PageSection;
use App\Models\SeoMeta;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // Speakers
        $speakers = [];
        $speakerData = [
            ['name_ar' => 'د. أحمد الشمري', 'name_en' => 'Dr. Ahmed Al-Shamri', 'title_ar' => 'استشاري جراحة', 'title_en' => 'Surgery Consultant', 'specialization_ar' => 'جراحة عامة', 'specialization_en' => 'General Surgery'],
            ['name_ar' => 'د. فاطمة العتيبي', 'name_en' => 'Dr. Fatimah Al-Otaibi', 'title_ar' => 'أستاذ مشارك', 'title_en' => 'Associate Professor', 'specialization_ar' => 'طب الأسرة', 'specialization_en' => 'Family Medicine'],
            ['name_ar' => 'د. محمد القحطاني', 'name_en' => 'Dr. Mohammed Al-Qahtani', 'title_ar' => 'استشاري طب باطني', 'title_en' => 'Internal Medicine Consultant', 'specialization_ar' => 'طب باطني', 'specialization_en' => 'Internal Medicine'],
        ];
        foreach ($speakerData as $i => $data) {
            $speakers[] = Speaker::create(array_merge($data, [
                'bio_ar' => 'نبذة عن ' . $data['name_ar'],
                'bio_en' => 'Bio of ' . $data['name_en'],
                'email' => 'speaker' . ($i + 1) . '@restrack.sa',
                'slug' => \Str::slug($data['name_en']),
                'display_order' => $i + 1,
                'is_featured' => $i === 0,
                'is_visible' => true,
            ]));
        }

        // Levels
        $levels = [];
        $levelData = [
            ['title_ar' => 'المستوى الأول', 'title_en' => 'Level 1', 'description_ar' => 'أساسيات البحث العلمي', 'description_en' => 'Research Fundamentals'],
            ['title_ar' => 'المستوى الثاني', 'title_en' => 'Level 2', 'description_ar' => 'المنهجيات المتقدمة', 'description_en' => 'Advanced Methodologies'],
            ['title_ar' => 'المستوى الثالث', 'title_en' => 'Level 3', 'description_ar' => 'النشر والتطبيق', 'description_en' => 'Publishing & Application'],
        ];
        foreach ($levelData as $i => $data) {
            $levels[] = Level::create(array_merge($data, [
                'order' => $i + 1,
                'passing_score' => 70,
                'exam_questions_count' => 10,
                'is_published' => true,
            ]));
        }

        // Lectures
        foreach ($levels as $li => $level) {
            for ($j = 1; $j <= 3; $j++) {
                Lecture::create([
                    'level_id' => $level->id,
                    'speaker_id' => $speakers[$li]->id,
                    'title_ar' => 'المحاضرة ' . $j . ' - ' . $level->title_ar,
                    'title_en' => 'Lecture ' . $j . ' - ' . $level->title_en,
                    'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                    'video_provider' => 'youtube',
                    'order' => $j,
                    'duration_minutes' => rand(20, 60),
                    'is_published' => true,
                    'is_free_preview' => $li === 0 && $j === 1,
                ]);
            }
        }

        // Questions (10 per level)
        foreach ($levels as $level) {
            for ($q = 1; $q <= 10; $q++) {
                Question::create([
                    'level_id' => $level->id,
                    'question_ar' => 'سؤال ' . $q . ' للمستوى ' . $level->title_ar . '؟',
                    'question_en' => 'Question ' . $q . ' for ' . $level->title_en . '?',
                    'type' => $q <= 8 ? 'mcq' : 'true_false',
                    'options_ar' => $q <= 8 ? ['الخيار أ', 'الخيار ب', 'الخيار ج', 'الخيار د'] : ['صح', 'خطأ'],
                    'options_en' => $q <= 8 ? ['Option A', 'Option B', 'Option C', 'Option D'] : ['True', 'False'],
                    'correct_answer' => $q <= 8 ? (string)rand(0, 3) : (rand(0, 1) ? 'true' : 'false'),
                    'difficulty' => ['easy', 'medium', 'hard'][rand(0, 2)],
                    'explanation_ar' => 'شرح الإجابة الصحيحة',
                    'explanation_en' => 'Explanation of the correct answer',
                ]);
            }
        }

        // FAQs
        $faqData = [
            ['question_ar' => 'ما هو برنامج ريسترك؟', 'question_en' => 'What is Restrack?', 'answer_ar' => 'برنامج تدريبي متخصص في البحث العلمي الطبي.', 'answer_en' => 'A specialized training program in medical scientific research.'],
            ['question_ar' => 'كم تكلفة التسجيل؟', 'question_en' => 'How much does it cost?', 'answer_ar' => 'رسوم التسجيل 899 ريال سعودي.', 'answer_en' => 'Registration fee is 899 SAR.'],
            ['question_ar' => 'هل أحصل على شهادة؟', 'question_en' => 'Do I get a certificate?', 'answer_ar' => 'نعم، تحصل على شهادة معتمدة عند إتمام جميع المستويات.', 'answer_en' => 'Yes, you receive a certified certificate upon completing all levels.'],
            ['question_ar' => 'كم مدة البرنامج؟', 'question_en' => 'How long is the program?', 'answer_ar' => 'الوصول مفتوح ويمكنك التعلم بالسرعة التي تناسبك.', 'answer_en' => 'Access is open and you can learn at your own pace.'],
        ];
        foreach ($faqData as $i => $data) {
            Faq::create(array_merge($data, ['display_order' => $i + 1]));
        }

        // Guidelines
        $guidelineData = [
            ['name' => 'Ministry of Health', 'type' => 'national'],
            ['name' => 'SCFHS', 'type' => 'national'],
        ];
        foreach ($guidelineData as $i => $data) {
            Guideline::create(array_merge($data, ['logo' => 'guidelines/placeholder.png', 'display_order' => $i + 1]));
        }

        // Page sections for home page
        $homeSections = [
            ['section_key' => 'hero', 'title_ar' => 'ابدأ رحلتك البحثية', 'title_en' => 'Start Your Research Journey', 'content_ar' => 'برنامج تدريبي متكامل في البحث العلمي الطبي', 'content_en' => 'A comprehensive training program in medical scientific research'],
            ['section_key' => 'about', 'title_ar' => 'عن البرنامج', 'title_en' => 'About the Program', 'content_ar' => 'ريسترك هو برنامج رائد في تعليم البحث العلمي', 'content_en' => 'Restrack is a leading program in scientific research education'],
            ['section_key' => 'cta', 'title_ar' => 'سجل الآن', 'title_en' => 'Register Now', 'content_ar' => 'انضم إلى أكثر من ١٠٠٠ باحث', 'content_en' => 'Join over 1000 researchers'],
        ];
        foreach ($homeSections as $i => $data) {
            PageSection::create(array_merge($data, ['page_slug' => 'home', 'display_order' => $i + 1]));
        }

        // SEO meta for main pages
        $seoPages = ['home', 'speakers', 'contact', 'checkout'];
        foreach ($seoPages as $page) {
            SeoMeta::firstOrCreate(['page_slug' => $page], [
                'meta_title_ar' => 'ريسترك - ' . $page,
                'meta_title_en' => 'Restrack - ' . ucfirst($page),
                'meta_description_ar' => 'برنامج ريسترك للتدريب على البحث العلمي الطبي',
                'meta_description_en' => 'Restrack medical research training program',
            ]);
        }
    }
}
