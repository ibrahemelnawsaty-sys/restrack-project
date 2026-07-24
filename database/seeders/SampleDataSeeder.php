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
            ['title_ar' => 'الباحث المبتدئ', 'title_en' => 'Beginner Researcher', 'description_ar' => 'أساسيات البحث الطبي: مقدمة في البحث، أخلاقيات البحث ولجان IRB، البحث في الأدبيات، صياغة الأسئلة البحثية، أنواع الدراسات، وأساسيات التوثيق.', 'description_en' => 'Foundations of Medical Research: introduction to research, research ethics & IRB, literature search, research questions, study types, and referencing basics.'],
            ['title_ar' => 'الباحث المتوسط', 'title_en' => 'Intermediate Researcher', 'description_ar' => 'تصميم البحث وإدارة البيانات: تصميم الدراسات، طرق المعاينة، جمع البيانات، أساسيات الإحصاء، كتابة المقترح، إدارة البيانات، والتحيّز والعوامل المربكة.', 'description_en' => 'Research Design & Data Management: study design, sampling methods, data collection, statistical basics, proposal writing, data management, and bias & confounding.'],
            ['title_ar' => 'الباحث الخبير', 'title_en' => 'Expert Researcher', 'description_ar' => 'الكتابة العلمية والنشر: كتابة المخطوطة، اختيار المجلة، مراجعة الأقران، المراجعات المنهجية، أخلاقيات النشر، وأساسيات كتابة المنح.', 'description_en' => 'Scientific Writing & Publication: manuscript writing, journal selection, peer review, systematic reviews, publication ethics, and grant writing basics.'],
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
            ['question_ar' => 'هل أحصل على شهادة؟', 'question_en' => 'Do I get a certificate?', 'answer_ar' => 'نعم، تحصل على شهادة إكمال موثّقة عند إتمام جميع المستويات، مع محاولات اختبار لا محدودة.', 'answer_en' => 'Yes, you receive a verified certificate of completion upon finishing all levels, with unlimited exam attempts.'],
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
            Guideline::create(array_merge($data, ['logo' => null, 'display_order' => $i + 1]));
        }

        // Page sections for home page
        $homeSections = [
            ['section_key' => 'hero', 'title_ar' => 'Research Track Platform', 'title_en' => 'Research Track Platform', 'subtitle_ar' => 'From Beginner to Expert in Medical Research', 'subtitle_en' => 'From Beginner to Expert in Medical Research', 'content_ar' => '', 'content_en' => ''],
            ['section_key' => 'about', 'title_ar' => 'منصة احترافية لإتقان البحث الطبي', 'title_en' => 'A professional platform to master medical research', 'content_ar' => 'ريستراك منصة تعليمية احترافية تُنمّي مهارات البحث الطبي عبر برامج منظّمة، وتقود المتعلّمين من مستوى المبتدئ إلى الخبير.', 'content_en' => 'Restrack is a professional learning platform that develops medical research skills through structured programs, guiding learners from beginner to expert levels'],
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
