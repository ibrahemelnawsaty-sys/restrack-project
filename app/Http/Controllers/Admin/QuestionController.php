<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $query = Question::with('level');

        if ($levelId = $request->input('level_id')) {
            $query->where('level_id', $levelId);
        }

        $questions = $query->latest()->paginate(20);
        $levels = Level::ordered()->get();

        return view('admin.questions.index', compact('questions', 'levels'));
    }

    public function create()
    {
        $levels = Level::ordered()->get();
        return view('admin.questions.create', compact('levels'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'level_id' => ['required', 'exists:levels,id'],
            'question_ar' => ['required', 'string'],
            'question_en' => ['required', 'string'],
            'type' => ['required', 'in:mcq,true_false'],
            'options_ar' => ['required', 'array', 'min:2'],
            'options_en' => ['required', 'array', 'min:2'],
            'correct_answer' => ['required', 'string'],
            'explanation_ar' => ['nullable', 'string'],
            'explanation_en' => ['nullable', 'string'],
            'difficulty' => ['required', 'in:easy,medium,hard'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        Question::create($validated);

        return redirect()->route('admin.questions.index')
            ->with('success', __('messages.question_created'));
    }

    public function edit(Question $question)
    {
        $levels = Level::ordered()->get();
        return view('admin.questions.edit', compact('question', 'levels'));
    }

    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'level_id' => ['required', 'exists:levels,id'],
            'question_ar' => ['required', 'string'],
            'question_en' => ['required', 'string'],
            'type' => ['required', 'in:mcq,true_false'],
            'options_ar' => ['required', 'array', 'min:2'],
            'options_en' => ['required', 'array', 'min:2'],
            'correct_answer' => ['required', 'string'],
            'explanation_ar' => ['nullable', 'string'],
            'explanation_en' => ['nullable', 'string'],
            'difficulty' => ['required', 'in:easy,medium,hard'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        $question->update($validated);

        return redirect()->route('admin.questions.index')
            ->with('success', __('messages.question_updated'));
    }

    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->route('admin.questions.index')
            ->with('success', __('messages.question_deleted'));
    }
}
