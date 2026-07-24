<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\ExamAttempt;
use App\Models\Level;
use App\Models\StudentProgress;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $levels = Level::published()->ordered()->with('lectures')->get();

        $levelProgress = [];
        $completedLectures = 0;
        $totalLecturesAll = 0;
        $passedLevelIds = collect();

        foreach ($levels as $level) {
            $totalLectures = $level->lectures->count();
            $completed = StudentProgress::where('user_id', $user->id)
                ->whereIn('lecture_id', $level->lectures->pluck('id'))
                ->where('is_completed', true)
                ->count();

            $percentage = $totalLectures > 0 ? round(($completed / $totalLectures) * 100) : 0;
            $levelProgress[$level->id] = $percentage;

            $completedLectures += $completed;
            $totalLecturesAll += $totalLectures;

            $bestAttempt = ExamAttempt::where('user_id', $user->id)
                ->where('level_id', $level->id)
                ->passed()
                ->orderByDesc('score')
                ->first();

            if ($bestAttempt) {
                $passedLevelIds->push($level->id);
            }
        }

        $overallProgress = $totalLecturesAll > 0 ? round(($completedLectures / $totalLecturesAll) * 100) : 0;
        $passedExams = $passedLevelIds->count();
        $certificates = Certificate::where('user_id', $user->id)->get();
        $certificatesCount = $certificates->count();

        // Determine locked levels: a level is locked if the previous level's exam hasn't been passed
        $lockedLevels = [];
        $sortedLevels = $levels->sortBy('order')->values();
        foreach ($sortedLevels as $i => $level) {
            if ($i === 0) continue;
            $prevLevel = $sortedLevels[$i - 1];
            if (!$passedLevelIds->contains($prevLevel->id)) {
                $lockedLevels[] = $level->id;
            }
        }

        return view('student.dashboard', compact(
            'levels', 'levelProgress', 'overallProgress',
            'completedLectures', 'passedExams', 'certificatesCount',
            'passedLevelIds', 'lockedLevels', 'certificates'
        ));
    }
}
