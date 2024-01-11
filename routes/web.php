<?php

use App\Http\Controllers\ProfileController;
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
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::resource('quizzes', QuizController::class);

    Route::get('quizzes/{quiz}/questions', [QuestionController::class, 'index'])->name('questions.index');
    Route::get('quizzes/{quiz}/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('quizzes/{quiz}/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::resource('questions', QuestionController::class)->except(['index', 'create', 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
