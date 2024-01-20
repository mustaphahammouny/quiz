<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\QuizRequest;
use App\Http\Resources\QuizResource;
use App\Models\Quiz;
use App\Services\QuizService;
use Exception;

class QuizController extends Controller
{
    public function __construct(protected QuizService $quizService)
    {
    }

    public function index()
    {
        $quizzes = Quiz::paginate(10);

        return QuizResource::collection($quizzes);
    }

    public function show(Quiz $quiz)
    {
        return new QuizResource($quiz);
    }

    public function store(QuizRequest $request)
    {
        $data = $request->validated();

        try {
            $quiz = $this->quizService->store($data);

            return new QuizResource($quiz);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(QuizRequest $request, Quiz $quiz)
    {
        $data = $request->validated();

        try {
            $quiz = $this->quizService->update($quiz, $data);

            return new QuizResource($quiz);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Quiz $quiz)
    {
        try {
            $quiz = $this->quizService->delete($quiz);

            return new QuizResource($quiz);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
