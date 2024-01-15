<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::withCount('questions')
            ->whereNull('end_time')
            ->orWhere('end_time', '>', now())
            ->paginate(12);

        return view('tenant.quizzes.index', compact('quizzes'));
    }
}
