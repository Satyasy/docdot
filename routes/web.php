<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/features', function () {
    return Inertia::render('Features');
})->name('features');

Route::get('/article', function () {
    return Inertia::render('Article');
})->name('article');

// Consultation - accessible by everyone, but submit requires auth
Route::get('/consultation', [ChatController::class, 'index'])->name('consultation');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // OTP Verification (doesn't require verified middleware)
    Route::get('/verify-otp', [AuthController::class, 'showVerifyOtp'])->name('verify.otp');
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
    Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('resend.otp');
});

// Routes that require verified email
Route::middleware(['auth', 'verified'])->group(function () {
    // Profile
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    
    // Consultation Chat (requires auth + verified)
    Route::post('/consultation/session', [ChatController::class, 'createSession']);
    Route::get('/consultation/session/{session}/messages', [ChatController::class, 'getMessages']);
    Route::post('/consultation/session/{session}/message', [ChatController::class, 'sendMessage']);
    Route::delete('/consultation/session/{session}', [ChatController::class, 'deleteSession']);
});
