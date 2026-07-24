<?php

use App\Http\Controllers\Student\CertificateController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\ExamController;
use App\Http\Controllers\Student\LectureController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\SurveyController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'subscribed'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Lectures
    Route::get('/lectures/{lecture}', [LectureController::class, 'show'])->name('lectures.show');
    Route::post('/lectures/{lecture}/progress', [LectureController::class, 'updateProgress'])->name('lectures.progress');

    // Exams
    Route::get('/exams/{level}', [ExamController::class, 'show'])->name('exams.show');
    Route::post('/exams/{level}', [ExamController::class, 'submit'])->name('exams.submit');
    Route::get('/exams/{level}/history', [ExamController::class, 'history'])->name('exams.history');

    // Certificates
    Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');
    Route::get('/certificates/{certificate}/download', [CertificateController::class, 'download'])->name('certificates.download');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Survey
    Route::get('/survey', [SurveyController::class, 'create'])->name('survey.create');
    Route::post('/survey', [SurveyController::class, 'store'])->name('survey.store');
});
