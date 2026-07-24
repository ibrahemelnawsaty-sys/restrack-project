<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\ContactMessage;
use App\Models\ExamAttempt;
use App\Models\Subscription;
use App\Models\SurveyResponse;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'active_subscriptions' => Subscription::active()->count(),
            'total_revenue' => Subscription::active()->sum('amount'),
            'certificates_issued' => Certificate::count(),
            'pending_contacts' => ContactMessage::new()->count(),
            'avg_exam_score' => ExamAttempt::avg('score'),
            'pass_rate' => ExamAttempt::count() > 0
                ? round(ExamAttempt::passed()->count() / ExamAttempt::count() * 100, 1)
                : 0,
            'survey_avg' => SurveyResponse::avg('overall_satisfaction'),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $recentPayments = Subscription::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentPayments'));
    }
}
