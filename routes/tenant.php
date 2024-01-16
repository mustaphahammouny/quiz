<?php

declare(strict_types=1);

use App\Http\Controllers\Tenant\AttemptController;
use App\Http\Controllers\Tenant\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Tenant\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Tenant\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Tenant\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Tenant\Auth\NewPasswordController;
use App\Http\Controllers\Tenant\Auth\PasswordController;
use App\Http\Controllers\Tenant\Auth\PasswordResetLinkController;
use App\Http\Controllers\Tenant\Auth\RegisteredUserController;
use App\Http\Controllers\Tenant\Auth\VerifyEmailController;
use App\Http\Controllers\Tenant\ProfileController;
use App\Http\Controllers\Tenant\QuizController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])
    ->name('tenant.')
    ->group(function () {
        Route::view('/', 'tenant.welcome');

        Route::middleware('guest')->group(function () {
            Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

            Route::post('register', [RegisteredUserController::class, 'store']);

            Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

            Route::post('login', [AuthenticatedSessionController::class, 'store']);

            Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

            Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

            Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

            Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
        });

        Route::middleware('auth:tenant')->group(function () {
            Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

            Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

            Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

            Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

            Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

            Route::put('password', [PasswordController::class, 'update'])->name('password.update');

            Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

            Route::view('dashboard', 'tenant.dashboard')->name('dashboard');

            Route::get('quizzes', [QuizController::class, 'index'])->name('quizzes.index');
            Route::post('quizzes/{quiz}/subscribe', [QuizController::class, 'subscribe'])->name('quizzes.subscribe');
            Route::post('quizzes/{quiz}/unsubscribe', [QuizController::class, 'unsubscribe'])->name('quizzes.unsubscribe');
            Route::get('quizzes/{token}', [QuizController::class, 'take'])->name('quizzes.take');

            Route::post('quizzes/{quiz}/attempts', [AttemptController::class, 'store'])->name('attempts.store');
            Route::get('attempts', [AttemptController::class, 'index'])->name('attempts.index');
            Route::get('attempts/{attempt}', [AttemptController::class, 'show'])->name('attempts.show');
        });
    });
