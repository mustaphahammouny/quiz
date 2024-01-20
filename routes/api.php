<?php

use App\Http\Controllers\Api\AttemptController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChoiceController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Middleware\InitializeTenancyByUser;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'verified', InitializeTenancyByUser::class])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::apiResource('quizzes', QuizController::class);

    Route::get('quizzes/{quiz}/questions', [QuestionController::class, 'index']);
    Route::apiResource('questions', QuestionController::class)->except('index');

    Route::get('questions/{question}/choices', [ChoiceController::class, 'index']);
    Route::apiResource('choices', ChoiceController::class)->except('index');

    Route::apiResource('members', MemberController::class);

    Route::apiResource('attempts', AttemptController::class);
});
