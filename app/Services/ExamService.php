<?php

namespace App\Services;

use App\Mail\CertificateIssued;
use App\Models\Certificate;
use App\Models\ExamAttempt;
use App\Models\Level;
use App\Models\Question;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ExamService
{
    public function generateExam(Level $level): array
    {
        $questions = Question::where('level_id', $level->id)
            ->active()
            ->inRandomOrder()
            ->limit($level->exam_questions_count)
            ->get();

        $examQuestions = $questions->map(function ($q) {
            $locale = app()->getLocale();
            return [
                'id' => $q->id,
                'question' => $locale === 'ar' ? $q->question_ar : $q->question_en,
                'type' => $q->type,
                'options' => $locale === 'ar' ? $q->options_ar : $q->options_en,
            ];
        })->toArray();

        session(["exam_{$level->id}_questions" => $questions->pluck('id')->toArray()]);

        return $examQuestions;
    }

    public function gradeExam(Level $level, array $answers): array
    {
        $questionIds = session("exam_{$level->id}_questions", []);
        $questions = Question::whereIn('id', $questionIds)->get()->keyBy('id');

        $correct = 0;
        $total = $questions->count();
        $snapshot = [];

        foreach ($questions as $question) {
            $userAnswer = $answers[$question->id] ?? null;
            $isCorrect = $userAnswer !== null
                && trim((string) $userAnswer) === trim((string) $question->correct_answer);
            if ($isCorrect) $correct++;

            $snapshot[] = [
                'question_id' => $question->id,
                'question_ar' => $question->question_ar,
                'question_en' => $question->question_en,
                'user_answer' => $userAnswer,
                'correct_answer' => $question->correct_answer,
                'is_correct' => $isCorrect,
            ];
        }

        $score = $total > 0 ? round(($correct / $total) * 100, 2) : 0;
        $passed = $score >= $level->passing_score;

        session()->forget("exam_{$level->id}_questions");

        return [
            'score' => $score,
            'correct' => $correct,
            'total' => $total,
            'passed' => $passed,
            'snapshot' => $snapshot,
        ];
    }

    public function handlePassed(ExamAttempt $attempt): void
    {
        $existingCert = Certificate::where('user_id', $attempt->user_id)
            ->where('level_id', $attempt->level_id)
            ->where('type', 'level')
            ->exists();

        if (!$existingCert) {
            $certificate = Certificate::create([
                'user_id' => $attempt->user_id,
                'level_id' => $attempt->level_id,
                'certificate_number' => Certificate::generateNumber(),
                'score' => $attempt->score,
                'type' => 'level',
                'issued_at' => now(),
            ]);

            $this->sendCertificateEmail($certificate);
        }

        $this->checkFinalCertificate($attempt->user_id);
    }

    private function checkFinalCertificate(int $userId): void
    {
        $totalLevels = Level::published()->count();
        $passedLevels = Certificate::where('user_id', $userId)
            ->where('type', 'level')
            ->count();

        if ($passedLevels >= $totalLevels && $totalLevels > 0) {
            $hasFinal = Certificate::where('user_id', $userId)
                ->where('type', 'final')
                ->exists();

            if (!$hasFinal) {
                $avgScore = Certificate::where('user_id', $userId)
                    ->where('type', 'level')
                    ->avg('score');

                $certificate = Certificate::create([
                    'user_id' => $userId,
                    'level_id' => null,
                    'certificate_number' => Certificate::generateNumber(),
                    'score' => round($avgScore, 2),
                    'type' => 'final',
                    'issued_at' => now(),
                ]);

                $this->sendCertificateEmail($certificate);
            }
        }
    }

    private function sendCertificateEmail(Certificate $certificate): void
    {
        try {
            $certificate->loadMissing('user');
            if ($certificate->user?->email) {
                Mail::to($certificate->user->email)->send(new CertificateIssued($certificate));
            }
        } catch (\Throwable $e) {
            Log::warning('Certificate email failed: ' . $e->getMessage(), ['certificate_id' => $certificate->id]);
        }
    }
}
