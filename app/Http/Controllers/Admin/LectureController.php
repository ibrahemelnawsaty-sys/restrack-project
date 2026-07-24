<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Models\Level;
use App\Models\Speaker;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    public function index(Level $level)
    {
        $lectures = $level->lectures()->with('speaker')->ordered()->paginate(20);
        return view('admin.lectures.index', compact('level', 'lectures'));
    }

    public function create(Level $level)
    {
        $speakers = Speaker::visible()->ordered()->get();
        return view('admin.lectures.create', compact('level', 'speakers'));
    }

    public function store(Request $request, Level $level)
    {
        $validated = $request->validate([
            'speaker_id' => ['nullable', 'exists:speakers,id'],
            'order' => ['required', 'integer', 'min:1'],
            'title_ar' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'video_url' => ['required', 'url', 'max:500'],
            'video_provider' => ['required', 'in:vimeo,youtube,custom'],
            'duration_minutes' => ['nullable', 'integer', 'min:1'],
            'is_published' => ['boolean'],
            'is_free_preview' => ['boolean'],
        ]);

        $validated['is_published'] = $request->boolean('is_published', true);
        $validated['is_free_preview'] = $request->boolean('is_free_preview');

        $level->lectures()->create($validated);

        return redirect()->route('admin.levels.lectures.index', $level)
            ->with('success', __('messages.lecture_created'));
    }

    public function edit(Level $level, Lecture $lecture)
    {
        $speakers = Speaker::visible()->ordered()->get();
        return view('admin.lectures.edit', compact('level', 'lecture', 'speakers'));
    }

    public function update(Request $request, Level $level, Lecture $lecture)
    {
        $validated = $request->validate([
            'speaker_id' => ['nullable', 'exists:speakers,id'],
            'order' => ['required', 'integer', 'min:1'],
            'title_ar' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'video_url' => ['required', 'url', 'max:500'],
            'video_provider' => ['required', 'in:vimeo,youtube,custom'],
            'duration_minutes' => ['nullable', 'integer', 'min:1'],
            'is_published' => ['boolean'],
            'is_free_preview' => ['boolean'],
        ]);

        $validated['is_published'] = $request->boolean('is_published', true);
        $validated['is_free_preview'] = $request->boolean('is_free_preview');

        $lecture->update($validated);

        return redirect()->route('admin.levels.lectures.index', $level)
            ->with('success', __('messages.lecture_updated'));
    }

    public function destroy(Level $level, Lecture $lecture)
    {
        $lecture->delete();

        return redirect()->route('admin.levels.lectures.index', $level)
            ->with('success', __('messages.lecture_deleted'));
    }
}
