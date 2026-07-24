<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ExamAttempt;
use App\Models\Level;
use App\Services\ExamService;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function show(Level $level, ExamService $examService)
    {
        $questions = $examService->generateExam($level);

        session(["exam_{$level->id}_started" => now()]);

        return view('student.exam', compact('level', 'questions'));
    }

    public function submit(Request $request, Level $level, ExamService $examService)
    {
        $validated = $request->validate([
            'answers' => ['required', 'array'],
            'answers.*' => ['required', 'string'],
        ]);

        $startedAt = session("exam_{$level->id}_started");
        $timeSpent = $startedAt ? now()->diffInSeconds($startedAt) : null;

        $result = $examService->gradeExam($level, $validated['answers']);

        $attempt = ExamAttempt::create([
            'user_id' => auth()->id(),
            'level_id' => $level->id,
            'score' => $result['score'],
            'total_questions' => $result['total'],
            'correct_answers' => $result['correct'],
            'passed' => $result['passed'],
            'time_spent_seconds' => $timeSpent,
            'questions_snapshot' => $result['snapshot'],
            'started_at' => $startedAt,
            'completed_at' => now(),
        ]);

        session()->forget("exam_{$level->id}_started");

        if ($result['passed']) {
            $examService->handlePassed($attempt);
        }

        return view('student.exam-result', compact('attempt', 'result', 'level'));
    }

    public function history(Level $level)
    {
        $attempts = ExamAttempt::where('user_id', auth()->id())
            ->where('level_id', $level->id)
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('student.exam-history', compact('level', 'attempts'));
    }
}
