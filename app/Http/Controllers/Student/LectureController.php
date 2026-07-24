<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Models\StudentProgress;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    public function show(Lecture $lecture)
    {
        $lecture->load(['level', 'speaker']);

        $progress = StudentProgress::firstOrCreate(
            ['user_id' => auth()->id(), 'lecture_id' => $lecture->id],
            ['last_position_seconds' => 0, 'watch_duration_seconds' => 0]
        );

        $level = $lecture->level;
        $levelLectures = Lecture::where('level_id', $lecture->level_id)
            ->published()->ordered()->get();

        $isCompleted = $progress->is_completed;

        $completedLectureIds = StudentProgress::where('user_id', auth()->id())
            ->whereIn('lecture_id', $levelLectures->pluck('id'))
            ->where('is_completed', true)
            ->pluck('lecture_id');

        return view('student.lecture', compact('lecture', 'progress', 'levelLectures', 'level', 'isCompleted', 'completedLectureIds'));
    }

    public function updateProgress(Request $request, Lecture $lecture)
    {
        $validated = $request->validate([
            'position' => ['required', 'integer', 'min:0'],
            'duration' => ['required', 'integer', 'min:0'],
            'completed' => ['sometimes', 'boolean'],
        ]);

        $progress = StudentProgress::updateOrCreate(
            ['user_id' => auth()->id(), 'lecture_id' => $lecture->id],
            [
                'last_position_seconds' => $validated['position'],
                'watch_duration_seconds' => $validated['duration'],
                'is_completed' => $validated['completed'] ?? false,
                'completed_at' => ($validated['completed'] ?? false) ? now() : null,
            ]
        );

        return response()->json(['status' => 'ok', 'progress' => $progress]);
    }
}
