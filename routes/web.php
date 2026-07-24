<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CertificateVerificationController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentWebhookController;
use Illuminate\Support\Facades\Route;

// Language switcher
Route::get('lang/{locale}', function (string $locale) {
    if (in_array($locale, ['ar', 'en'])) {
        session(['locale' => $locale]);
        if (auth()->check()) {
            auth()->user()->update(['locale' => $locale]);
        }
    }
    return back();
})->name('lang.switch');

// Public pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/speakers', [HomeController::class, 'speakers'])->name('speakers');
Route::get('/speakers/{slug}', [HomeController::class, 'speakerShow'])->name('speakers.show');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/verify/{number}', [CertificateVerificationController::class, 'verify'])->name('certificate.verify');

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Checkout (requires auth)
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/coupon', [CheckoutController::class, 'applyCoupon'])->name('checkout.coupon');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
});

// Payment webhooks (no CSRF)
Route::post('/webhooks/moyasar', [PaymentWebhookController::class, 'moyasar'])->name('webhooks.moyasar');

// Student routes
require __DIR__.'/student.php';

// Admin routes
require __DIR__.'/admin.php';
