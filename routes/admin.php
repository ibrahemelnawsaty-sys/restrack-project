<?php

use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\AppearanceController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GuidelineController;
use App\Http\Controllers\Admin\LectureController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\PageSectionController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SpeakerController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\SurveyController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users
    Route::resource('users', UserController::class)->except('show');

    // Speakers
    Route::resource('speakers', SpeakerController::class)->except('show');

    // Levels & Lectures
    Route::resource('levels', LevelController::class)->except('show');
    Route::resource('levels.lectures', LectureController::class)->except('show');

    // Questions
    Route::resource('questions', QuestionController::class)->except('show');

    // Subscriptions
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::get('/subscriptions/{subscription}', [SubscriptionController::class, 'show'])->name('subscriptions.show');
    Route::post('/subscriptions/{subscription}/activate', [SubscriptionController::class, 'activate'])->name('subscriptions.activate');
    Route::post('/subscriptions/{subscription}/refund', [SubscriptionController::class, 'refund'])->name('subscriptions.refund');

    // Coupons
    Route::resource('coupons', CouponController::class)->except('show');

    // Page Sections (CMS)
    Route::get('/pages/{slug}/edit', [PageSectionController::class, 'edit'])->name('pages.edit');
    Route::put('/pages/{slug}', [PageSectionController::class, 'update'])->name('pages.update');

    // SEO
    Route::get('/seo', [SeoController::class, 'index'])->name('seo.index');
    Route::get('/seo/{slug}/edit', [SeoController::class, 'edit'])->name('seo.edit');
    Route::put('/seo/{slug}', [SeoController::class, 'update'])->name('seo.update');

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');

    // Appearance (header tagline + footer + social — admin-editable)
    Route::get('/appearance', [AppearanceController::class, 'index'])->name('appearance.index');
    Route::put('/appearance', [AppearanceController::class, 'update'])->name('appearance.update');

    // FAQs
    Route::resource('faqs', FaqController::class)->except('show');

    // Guidelines
    Route::resource('guidelines', GuidelineController::class)->except('show');

    // Announcements (top bar + popup, admin-managed)
    Route::resource('announcements', AnnouncementController::class)->except('show');

    // Contact Messages
    Route::get('/contacts', [ContactMessageController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [ContactMessageController::class, 'show'])->name('contacts.show');
    Route::post('/contacts/{contact}/reply', [ContactMessageController::class, 'reply'])->name('contacts.reply');
    Route::delete('/contacts/{contact}', [ContactMessageController::class, 'destroy'])->name('contacts.destroy');

    // Surveys
    Route::get('/surveys', [SurveyController::class, 'index'])->name('surveys.index');
});
