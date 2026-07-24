<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SurveyResponse;

class SurveyController extends Controller
{
    public function index()
    {
        $responses = SurveyResponse::with('user')->latest()->paginate(20);

        $stats = [
            'total' => SurveyResponse::count(),
            'avg_content' => round(SurveyResponse::avg('content_quality'), 1),
            'avg_clarity' => round(SurveyResponse::avg('clarity'), 1),
            'avg_speaker' => round(SurveyResponse::avg('speaker_quality'), 1),
            'avg_tech' => round(SurveyResponse::avg('tech_quality'), 1),
            'avg_ease' => round(SurveyResponse::avg('ease_of_use'), 1),
            'avg_overall' => round(SurveyResponse::avg('overall_satisfaction'), 1),
            'recommend_pct' => SurveyResponse::count() > 0
                ? round(SurveyResponse::where('would_recommend', true)->count() / SurveyResponse::count() * 100, 1)
                : 0,
        ];

        return view('admin.surveys.index', compact('responses', 'stats'));
    }
}
