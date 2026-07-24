<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\SurveyResponse;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function create()
    {
        $existing = SurveyResponse::where('user_id', auth()->id())->first();
        if ($existing) {
            return redirect()->route('student.dashboard')
                ->with('info', __('messages.survey_already_submitted'));
        }

        return view('student.survey');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content_quality' => ['required', 'integer', 'between:1,5'],
            'clarity' => ['required', 'integer', 'between:1,5'],
            'speaker_quality' => ['required', 'integer', 'between:1,5'],
            'tech_quality' => ['required', 'integer', 'between:1,5'],
            'ease_of_use' => ['required', 'integer', 'between:1,5'],
            'overall_satisfaction' => ['nullable', 'integer', 'between:1,5'],
            'would_recommend' => ['required', 'boolean'],
            'suggestions' => ['nullable', 'string', 'max:5000'],
        ]);

        SurveyResponse::create([
            ...$validated,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('student.dashboard')
            ->with('success', __('messages.survey_submitted'));
    }
}
