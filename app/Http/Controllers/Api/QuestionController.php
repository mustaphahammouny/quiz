<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Models\Quiz;

class QuestionController extends Controller
{
    public function index(Quiz $quiz)
    {
        $questions = $quiz->questions()->paginate(10);

        return QuestionResource::collection($questions);
    }

    public function show(Question $question)
    {
        return new QuestionResource($question);
    }
}
