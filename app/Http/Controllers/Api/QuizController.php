<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuizResource;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::paginate(10);

        return QuizResource::collection($quizzes);
    }

    public function show(Quiz $quiz)
    {
        return new QuizResource($quiz);
    }
}
