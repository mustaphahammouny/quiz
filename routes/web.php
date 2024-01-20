<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\AttemptController;
use App\Http\Controllers\User\ChoiceController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\MemberController;
use App\Http\Controllers\User\QuestionController;
use App\Http\Controllers\User\QuizController;
use App\Http\Middleware\InitializeTenancyByUser;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', InitializeTenancyByUser::class])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('quizzes', QuizController::class);

    Route::get('quizzes/{quiz}/questions', [QuestionController::class, 'index'])->name('questions.index');
    Route::get('quizzes/{quiz}/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::resource('questions', QuestionController::class)->except(['index', 'create']);

    Route::get('questions/{question}/choices', [ChoiceController::class, 'index'])->name('choices.index');
    Route::get('questions/{question}/choices/create', [ChoiceController::class, 'create'])->name('choices.create');
    Route::resource('choices', ChoiceController::class)->except(['index', 'create']);

    Route::get('attempts', [AttemptController::class, 'index'])->name('attempts.index');
    Route::post('attempts/export', [AttemptController::class, 'export'])->name('attempts.export');
    Route::get('attempts/{attempt}', [AttemptController::class, 'show'])->name('attempts.show');

    Route::get('members', [MemberController::class, 'index'])->name('members.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
