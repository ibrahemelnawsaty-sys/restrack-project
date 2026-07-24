<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::ordered()->withCount(['lectures', 'questions'])->get();
        return view('admin.levels.index', compact('levels'));
    }

    public function create()
    {
        return view('admin.levels.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order' => ['required', 'integer', 'min:1'],
            'title_ar' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'passing_score' => ['required', 'integer', 'between:1,100'],
            'exam_questions_count' => ['required', 'integer', 'min:1'],
            'icon' => ['nullable', 'string', 'max:50'],
            'color' => ['nullable', 'string', 'max:7'],
            'is_published' => ['boolean'],
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        Level::create($validated);

        return redirect()->route('admin.levels.index')
            ->with('success', __('messages.level_created'));
    }

    public function edit(Level $level)
    {
        return view('admin.levels.edit', compact('level'));
    }

    public function update(Request $request, Level $level)
    {
        $validated = $request->validate([
            'order' => ['required', 'integer', 'min:1'],
            'title_ar' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'passing_score' => ['required', 'integer', 'between:1,100'],
            'exam_questions_count' => ['required', 'integer', 'min:1'],
            'icon' => ['nullable', 'string', 'max:50'],
            'color' => ['nullable', 'string', 'max:7'],
            'is_published' => ['boolean'],
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        $level->update($validated);

        return redirect()->route('admin.levels.index')
            ->with('success', __('messages.level_updated'));
    }

    public function destroy(Level $level)
    {
        $level->delete();

        return redirect()->route('admin.levels.index')
            ->with('success', __('messages.level_deleted'));
    }
}
