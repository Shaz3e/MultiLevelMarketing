<?php

use Illuminate\Support\Facades\Route;

// Admin Auth
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\ForgotPasswordController;
use App\Http\Controllers\User\Auth\ResetPasswordController;
use App\Http\Controllers\User\Auth\LogoutController;
use App\Http\Controllers\User\Auth\LockController;
use App\Http\Controllers\User\Auth\VerifyController;
// Dashboard
use App\Http\Controllers\User\DashboardController;

// Profile Controller
use App\Http\Controllers\User\ProfileController;

// Pin Code
use App\Http\Controllers\User\PinCodeController;
use App\Http\Controllers\User\ReferralController;
// Support Tickets
use App\Http\Controllers\User\SupportTicketController;

Route::middleware('guest')->group(function () {

    // Register
    Route::get('register', [RegisterController::class, 'view'])
        ->name('register');
    Route::post('register', [RegisterController::class, 'post'])
        ->name('register.store');

    // Verify Email
    Route::get('verify/{email}/{token}', [VerifyController::class, 'verify'])
        ->name('verify');

    // Login
    Route::get('login', [LoginController::class, 'view'])
        ->name('login');
    Route::post('login', [LoginController::class, 'post'])
        ->name('login.store');

    // Forgot Password
    Route::get('forgot-password', [ForgotPasswordController::class, 'view'])
        ->name('forgot.password');
    Route::post('forgot-password', [ForgotPasswordController::class, 'post'])
        ->name('forgot.password.store');

    // Reset Password
    Route::get('reset/{email}/{token}', [ResetPasswordController::class, 'view'])
        ->name('password.reset');
    Route::post('reset', [ResetPasswordController::class, 'post'])
        ->name('password.reset.store');

    // Referral Code Get User Data via ajax
    Route::get('get-referrer-user-data', [ReferralController::class, 'getUserData'])
        ->name('get.referrer-user-date');
});

Route::middleware('auth')->group(function () {

    // Lock
    Route::get('lock', [LockController::class, 'view'])
        ->name('lock');
    Route::post('lock', [LockController::class, 'post'])
        ->name('lock.store');

    // Logout
    Route::post('/logout', [LogoutController::class, 'logout'])
        ->name('logout');

    // User Dashboard
    Route::get('/', [DashboardController::class, 'dashboard'])
        ->name('dashboard');

    // Referrals
    Route::get('referrals/{id}', [ReferralController::class, 'index'])->name('referrals.index');
    Route::get('referrals/direct/{id}', [ReferralController::class, 'direct'])->name('referrals.direct');
    Route::get('referrals/level1/{id}', [ReferralController::class, 'levelOne'])->name('referrals.level1');
    Route::get('referrals/level2/{id}', [ReferralController::class, 'levelTwo'])->name('referrals.level2');
    Route::get('referrals/level3/{id}', [ReferralController::class, 'levelThree'])->name('referrals.level3');


    // Profile
    Route::get('my-profile', [ProfileController::class, 'profile'])
        ->name('profile');

    // Profile Kyc
    Route::get('my-profile/kyc', [ProfileController::class, 'kyc'])
        ->name('profile.kyc');

    // My Wallet
    Route::get('my-profile/payout', [ProfileController::class, 'payoutWallet'])
        ->name('profile.payout');

    // Profile Store
    Route::post('my-profile', [ProfileController::class, 'profileStore'])
        ->name('profile.store');

    // Pin Code
    Route::resource('pins', PinCodeController::class);
    Route::get('generate-pin', [PinCodeController::class, 'generatePin'])
        ->name('generate-pin');
    Route::get('check-pin', [PinCodeController::class, 'checkPin'])
        ->name('check-pin');


    // Support Ticket
    Route::resource('support-tickets', SupportTicketController::class);

    // Support Ticket Reply
    Route::post('support-tickets-reply/{supportTicketId}', [SupportTicketController::class, 'ticketReply'])
        ->name('support-tickets.reply');

    // Upload attachments for support tickets
    Route::post('support-tickets/upload-attachments', [SupportTicketController::class, 'uploadAttachments'])
        ->name('support-tickets.upload-attachments');
});
