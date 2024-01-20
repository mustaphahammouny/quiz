<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\QuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Services\QuestionService;
use Exception;

class QuestionController extends Controller
{
    public function __construct(protected QuestionService $questionService)
    {
    }

    public function index(Question $question)
    {
        $questions = $question->questions()->paginate(10);

        return QuestionResource::collection($questions);
    }

    public function show(Question $question)
    {
        return new QuestionResource($question);
    }

    public function store(QuestionRequest $request)
    {
        $data = $request->validated();

        try {
            $question = $this->questionService->store($data);

            return new QuestionResource($question);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(QuestionRequest $request, Question $question)
    {
        $data = $request->validated();

        try {
            $question = $this->questionService->update($question, $data);

            return new QuestionResource($question);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Question $question)
    {
        try {
            $question = $this->questionService->delete($question);

            return new QuestionResource($question);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
